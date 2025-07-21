<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ResumeController extends Controller
{
    function page(Request $request){
        return view('pages.resume');
    }

//    post education detils
function postEducationDetails(Request $request){
        $formData = $request->input();

        $affected = DB::table('educations')->insert($formData);

        return response()->json(['msg' => 'Education details saved successfully!'], 200);
}

    function getEducationDetails(Request $request){
        $educationalDetails = DB::table('educations')->get();
        return $educationalDetails;
    }

    function postExperienceDetails(Request $request){
        $formData = $request->input();

        $affected = DB::table('experiences')->insert($formData);

        return response()->json(['msg' => 'Experiences details saved successfully!'], 200);
    }

    function getExperienceDetails(Request $request){
        $formData = $request->input();
        $experienceDetails = DB::table('experiences')->get();
        return $experienceDetails;
    }

    function postLanguageDetails(Request $request){
        $formData = $request->input();

        $affected = DB::table('languages')->insert($formData);

        return response()->json(['msg' => 'Languages details saved successfully!'], 200);
    }

    function getLanguageDetails(Request $request){
        $LanguageDetails = DB::table('languages')->get();
        return $LanguageDetails;
    }

    function postProfessionalSkill(Request $request){
        $formData = $request->input();

        $affected = DB::table('skills')->insert($formData);

        return response()->json(['msg' => 'Skill details saved successfully!'], 200);
    }

    function getProfessionalSkill(Request $request){
        $allProffessionalSkills = DB::table('skills')->get();
        return $allProffessionalSkills;
    }

    function postResumeLink(Request $request){
        $formData = $request->input();

        $affected = DB::table('resumes')->insert($formData);

        return response()->json(['msg' => 'Resume link saved successfully!'], 200);
    }

    function getResumeLink(Request $request){
        $resumeLink = DB::table('resumes')->get();
        return $resumeLink;
    }

    function uploadResumeFile(Request $request){
        // Alleen admin kan uploaden
        if (!Session::get('admin_logged_in')) {
            return response()->json(['msg' => 'Geen toegang'], 403);
        }

        $request->validate([
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'password' => 'nullable|string|min:4',
            'is_protected' => 'boolean'
        ]);

        try {
            $file = $request->file('resume_file');
            $originalFilename = $file->getClientOriginalName();
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Sla het bestand op in storage/app/public/resumes
            $filePath = $file->storeAs('resumes', $filename, 'public');
            
            // Hash het wachtwoord als het is ingesteld
            $password = null;
            $isProtected = $request->boolean('is_protected', false);
            
            if ($isProtected && $request->filled('password')) {
                $password = Hash::make($request->password);
            } else {
                // Als is_protected true is maar geen wachtwoord, zet is_protected op false
                $isProtected = false;
            }

            // Verwijder oude resume records
            DB::table('resumes')->truncate();
            
            // Voeg nieuwe resume toe
            DB::table('resumes')->insert([
                'dwonloadLink' => '', // Leeg laten voor bestandsupload
                'file_path' => $filePath,
                'original_filename' => $originalFilename,
                'password' => $password,
                'is_protected' => $isProtected,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'msg' => 'Resume bestand succesvol geüpload!',
                'filename' => $originalFilename
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Fout bij uploaden: ' . $e->getMessage()
            ], 500);
        }
    }

    function downloadResume(Request $request){
        $resume = DB::table('resumes')->first();
        
        if (!$resume) {
            return response()->json(['msg' => 'Geen resume gevonden'], 404);
        }

        // Als er geen bestand is geüpload, gebruik de oude link methode
        if (empty($resume->file_path)) {
            return response()->json(['msg' => 'Geen bestand gevonden'], 404);
        }

        // Controleer of het bestand bestaat
        if (!Storage::disk('public')->exists($resume->file_path)) {
            return response()->json(['msg' => 'Bestand niet gevonden'], 404);
        }

        // Als het bestand beveiligd is met wachtwoord
        $isProtectedDownload = false;
        if ($resume->is_protected && $resume->password) {
            $providedPassword = $request->input('password');
            
            if (!$providedPassword || !Hash::check($providedPassword, $resume->password)) {
                return response()->json(['msg' => 'Incorrect wachtwoord'], 401);
            }
            
            $isProtectedDownload = true;
        }
        
        // Registreer de download in de statistieken
        DB::table('resume_downloads')->insert([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_protected_download' => $isProtectedDownload,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Download het bestand
        $filePath = Storage::disk('public')->path($resume->file_path);
        $originalFilename = $resume->original_filename ?: basename($resume->file_path);
        
        return response()->download($filePath, $originalFilename);
    }

    function getResumeInfo(Request $request){
        $resume = DB::table('resumes')->first();
        
        if (!$resume) {
            return response()->json(['msg' => 'Geen resume gevonden'], 404);
        }

        return response()->json([
            'has_file' => !empty($resume->file_path),
            'filename' => $resume->original_filename,
            'is_protected' => $resume->is_protected && !empty($resume->password),
            'has_password' => !empty($resume->password),
            'file_type' => !empty($resume->file_path) ? pathinfo($resume->file_path, PATHINFO_EXTENSION) : null,
            'upload_date' => $resume->updated_at
        ]);
    }
    
    function getResumeDownloadStats(Request $request) {
        // Alleen admin kan statistieken bekijken
        if (!Session::get('admin_logged_in')) {
            return response()->json(['msg' => 'Geen toegang'], 403);
        }
        
        // Totaal aantal downloads
        $totalDownloads = DB::table('resume_downloads')->count();
        
        // Aantal beveiligde downloads
        $protectedDownloads = DB::table('resume_downloads')
            ->where('is_protected_download', true)
            ->count();
            
        // Recente downloads (laatste 30 dagen)
        $recentDownloads = DB::table('resume_downloads')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
            
        // Downloads per dag (laatste 30 dagen)
        $downloadsPerDay = DB::table('resume_downloads')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        return response()->json([
            'total_downloads' => $totalDownloads,
            'protected_downloads' => $protectedDownloads,
            'recent_downloads' => $recentDownloads,
            'downloads_per_day' => $downloadsPerDay
        ]);
    }
}
