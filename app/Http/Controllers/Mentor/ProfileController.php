<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use App\Services\App\MentorService;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\App\MentorUpdateRequest;



final class ProfileController extends Controller
{
       public function __construct(
        private readonly MentorService $mentorService
        
    ) {}

    public function index(): View
    {
        $mentor = $this->mentorService->findById(Auth::user()->id_mentor);
        return view('mentor.profile',['mentor'=>$mentor]);
    }


    public function update(MentorUpdateRequest $request): RedirectResponse
    {
        $mentor = $this->mentorService->findById(Auth::user()->id_mentor);

           $updated = $this->mentorService->update($mentor,[
            'nama'=>  $request->input('nama'),
            'email'=>  $request->input('email'),
            'bio'=>  $request->input('bio'),
            'spesialisasi'=>  $request->input('spesialisasi')
           ]);

        return redirect()
            ->back()
            ->with('success', 'Profile berhasil diperbarui.');
    }
}
