<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    function page(Request $request){
        return view('pages.projects');
    }

    function postSingleProjectDetails(Request $request){
        $aboutDetails = $request->input();

        $affected = DB::table('projects')->insert($aboutDetails);

        return response()->json(['msg' => 'Projects Properties saved successfully!'], 200);
    }

    function getAllProjectDetails(Request $request){
        $allProjectDetails = DB::table('projects')->get();
        
        // Haal voor elk project de gekoppelde programmeertalen op
        foreach ($allProjectDetails as $project) {
            $project->languages = DB::table('project_programming_language')
                ->join('programming_languages', 'project_programming_language.programming_language_id', '=', 'programming_languages.id')
                ->where('project_programming_language.project_id', $project->id)
                ->select('programming_languages.*')
                ->get();
        }
        
        return $allProjectDetails;
    }
    
    // Nieuwe functies voor dashboard projectbeheer
    
    function dashboardProjects() {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $projects = DB::table('projects')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Haal alle programmeertalen op
        $programmingLanguages = DB::table('programming_languages')
            ->orderBy('name')
            ->get();
            
        // Haal voor elk project de gekoppelde programmeertalen op
        foreach ($projects as $project) {
            $project->languages = DB::table('project_programming_language')
                ->join('programming_languages', 'project_programming_language.programming_language_id', '=', 'programming_languages.id')
                ->where('project_programming_language.project_id', $project->id)
                ->select('programming_languages.*')
                ->get();
        }
        
        return view('dashboard.projects', compact('projects', 'programmingLanguages'));
    }
    
    function createProject(Request $request) {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'previewLink' => 'nullable|url|max:255',
            'thumbnail' => 'nullable|image|max:2048', // 2MB max
            'programming_languages' => 'nullable|array',
            'programming_languages.*' => 'exists:programming_languages,id'
        ]);
        
        try {
            // Verwerk thumbnail upload
            $thumbLink = '';
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $thumbLink = $file->storeAs('projects/thumbnails', $filename, 'public');
            }
            
            // Maak project aan
            $projectId = DB::table('projects')->insertGetId([
                'title' => $request->title,
                'details' => $request->details,
                'previewLink' => $request->previewLink ?? '',
                'thumbLink' => $thumbLink,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Koppel programmeertalen aan project
            if ($request->has('programming_languages')) {
                foreach ($request->programming_languages as $languageId) {
                    DB::table('project_programming_language')->insert([
                        'project_id' => $projectId,
                        'programming_language_id' => $languageId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
            
            return redirect()->route('dashboard.projects')->with('success', 'Project succesvol aangemaakt');
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects')->with('error', 'Fout bij aanmaken project: ' . $e->getMessage());
        }
    }
    
    function updateProject(Request $request, $id) {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'previewLink' => 'nullable|url|max:255',
            'thumbnail' => 'nullable|image|max:2048', // 2MB max
            'programming_languages' => 'nullable|array',
            'programming_languages.*' => 'exists:programming_languages,id'
        ]);
        
        try {
            // Haal bestaand project op
            $project = DB::table('projects')->where('id', $id)->first();
            if (!$project) {
                return redirect()->route('dashboard.projects')->with('error', 'Project niet gevonden');
            }
            
            // Verwerk thumbnail upload
            $thumbLink = $project->thumbLink;
            if ($request->hasFile('thumbnail')) {
                // Verwijder oude thumbnail
                if (!empty($project->thumbLink)) {
                    Storage::disk('public')->delete($project->thumbLink);
                }
                
                // Upload nieuwe thumbnail
                $file = $request->file('thumbnail');
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $thumbLink = $file->storeAs('projects/thumbnails', $filename, 'public');
            }
            
            // Update project
            DB::table('projects')
                ->where('id', $id)
                ->update([
                    'title' => $request->title,
                    'details' => $request->details,
                    'previewLink' => $request->previewLink ?? '',
                    'thumbLink' => $thumbLink,
                    'updated_at' => now()
                ]);
            
            // Update programmeertalen
            // Verwijder eerst alle bestaande koppelingen
            DB::table('project_programming_language')
                ->where('project_id', $id)
                ->delete();
                
            // Voeg nieuwe koppelingen toe
            if ($request->has('programming_languages')) {
                foreach ($request->programming_languages as $languageId) {
                    DB::table('project_programming_language')->insert([
                        'project_id' => $id,
                        'programming_language_id' => $languageId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
            
            return redirect()->route('dashboard.projects')->with('success', 'Project succesvol bijgewerkt');
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects')->with('error', 'Fout bij bijwerken project: ' . $e->getMessage());
        }
    }
    
    function deleteProject($id) {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        try {
            // Haal project op
            $project = DB::table('projects')->where('id', $id)->first();
            if (!$project) {
                return redirect()->route('dashboard.projects')->with('error', 'Project niet gevonden');
            }
            
            // Verwijder thumbnail
            if (!empty($project->thumbLink)) {
                Storage::disk('public')->delete($project->thumbLink);
            }
            
            // Verwijder project (koppelingen met programmeertalen worden automatisch verwijderd door de foreign key constraint)
            DB::table('projects')->where('id', $id)->delete();
            
            return redirect()->route('dashboard.projects')->with('success', 'Project succesvol verwijderd');
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects')->with('error', 'Fout bij verwijderen project: ' . $e->getMessage());
        }
    }
    
    // Programmeertalen beheer
    
    function createProgrammingLanguage(Request $request) {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:programming_languages,name',
            'color_code' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:255'
        ]);
        
        try {
            DB::table('programming_languages')->insert([
                'name' => $request->name,
                'color_code' => $request->color_code,
                'icon' => $request->icon,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return redirect()->route('dashboard.projects')->with('success', 'Programmeertaal succesvol toegevoegd');
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects')->with('error', 'Fout bij toevoegen programmeertaal: ' . $e->getMessage());
        }
    }
    
    function deleteProgrammingLanguage($id) {
        // Controleer admin login
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        try {
            // Controleer of de programmeertaal in gebruik is
            $inUse = DB::table('project_programming_language')
                ->where('programming_language_id', $id)
                ->exists();
                
            if ($inUse) {
                return redirect()->route('dashboard.projects')->with('error', 'Deze programmeertaal is in gebruik en kan niet worden verwijderd');
            }
            
            // Verwijder programmeertaal
            DB::table('programming_languages')->where('id', $id)->delete();
            
            return redirect()->route('dashboard.projects')->with('success', 'Programmeertaal succesvol verwijderd');
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects')->with('error', 'Fout bij verwijderen programmeertaal: ' . $e->getMessage());
        }
    }
}
