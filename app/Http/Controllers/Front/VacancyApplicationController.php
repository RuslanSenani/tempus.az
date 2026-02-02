<?php

namespace App\Http\Controllers\Front;

use App\Contracts\VacancyApplicationRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VacancyApplicationController extends Controller
{
    private VacancyApplicationRepositoryInterface $vacancyApplicationRepository;

    public function __construct(VacancyApplicationRepositoryInterface $vacancyApplicationRepository)
    {
        $this->vacancyApplicationRepository = $vacancyApplicationRepository;
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required',
            'vacancy_name' => 'required',
            'available_day' => 'required',
            'work_experience' => 'required',
            'message' => 'required|string|max:255',
        ]);


        $this->vacancyApplicationRepository->create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'vacancy_name' => $validated['vacancy_name'],
            'available_days' => $validated['available_day'],
            'work_experience' => $validated['work_experience'],
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Müraciətiniz uğurla göndərildi!');

    }
}
