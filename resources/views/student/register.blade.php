@extends('partials.app')
@section('title')
Student Registration
@endsection
@section('content')

<div class=" max-w-md mx-auto max-w-2xl rounded-xl bg-white p-8 shadow-lg">
<h2 class="mb-6 text-3xl font-semibold text-gray-900">Student Registration</h2>

<form method="POST" action="{{ route('student.store') }} " class="space-y-5"">
    @csrf

  <input type="text" class="input"name="name" placeholder="enter the name" />

<br><br>
 <label class="input validator">
  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <g
      stroke-linejoin="round"
      stroke-linecap="round"
      stroke-width="2.5"
      fill="none"
      stroke="currentColor"
    >
      <rect width="20" height="16" x="2" y="4" rx="2"></rect>
      <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
    </g>
  </svg>
  <input type="email"name="email" placeholder="email@site.com" required />
</label>
<div class="validator-hint hidden">Enter valid email address</div>
<br><br>
<label class="input validator">
  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <g
      stroke-linejoin="round"
      stroke-linecap="round"
      stroke-width="2.5"
      fill="none"
      stroke="currentColor"
    >
      <path
        d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"
      ></path>
      <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
    </g>
  </svg>
  <input
    type="password"
    required
    name="password"
    placeholder="Password"
    minlength="8"
    {{-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" --}}
    title="Must be more than 8 characters, including number, lowercase letter, uppercase letter"
  />
</label>
<p class="validator-hint hidden">
  Must be more than 8 characters, including
  <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
</p>
<br><br>
<label class="input validator">
  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
    <g fill="none">
      <path
        d="M7.25 11.5C6.83579 11.5 6.5 11.8358 6.5 12.25C6.5 12.6642 6.83579 13 7.25 13H8.75C9.16421 13 9.5 12.6642 9.5 12.25C9.5 11.8358 9.16421 11.5 8.75 11.5H7.25Z"
        fill="currentColor"
      ></path>
      <path
        fill-rule="evenodd"
        clip-rule="evenodd"
        d="M6 1C4.61929 1 3.5 2.11929 3.5 3.5V12.5C3.5 13.8807 4.61929 15 6 15H10C11.3807 15 12.5 13.8807 12.5 12.5V3.5C12.5 2.11929 11.3807 1 10 1H6ZM10 2.5H9.5V3C9.5 3.27614 9.27614 3.5 9 3.5H7C6.72386 3.5 6.5 3.27614 6.5 3V2.5H6C5.44771 2.5 5 2.94772 5 3.5V12.5C5 13.0523 5.44772 13.5 6 13.5H10C10.5523 13.5 11 13.0523 11 12.5V3.5C11 2.94772 10.5523 2.5 10 2.5Z"
        fill="currentColor"
      ></path>
    </g>
  </svg>
  <input
    type="tel"
    class="tabular-nums"
    required
    name="phone_number"
    placeholder="Phone"
    pattern="[0-9]*"
    minlength="10"
    maxlength="10"
    title="Must be 10 digits"
  />
</label>
<p class="validator-hint">Must be 10 digits</p>


<label class="input validator">
  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <g
      stroke-linejoin="round"
      stroke-linecap="round"
      stroke-width="2.5"
      fill="none"
      stroke="currentColor"
    >
      <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
      <circle cx="12" cy="7" r="4"></circle>
    </g>
  </svg>
  <input
    type="text"
    required
    name="college_name"
    placeholder="enter college name"
    pattern="[A-Za-z][A-Za-z0-9\-]*"
    minlength="3"
    maxlength="30"
    title="Only letters, numbers or dash"
  />
</label>
<p class="validator-hint">
  Must be 3 to 30 characters
  <br />containing only letters, numbers or dash
</p>
<select name="faculty" class="select">
  <option value="" selected>Pick a faculty</option>
  <option value="bbs">BBS</option>
  <option value="bba">BBA</option>
  <option value="it">It</option>
</select>
<br><br>
<select name="semester" class="select">
  <option value="" selected>enter semester</option>
  <option value="1st sem">1st sem</option>
  <option value="2nd sem">2nd sem</option>
  <option value="3rd sem">3rd sem</option>
  <option value="4th sem">4th sem</option>
  <option value="5th sem">5th sem</option>
  <option value="6th sem">6th sem</option>
  <option value="7th sem">7th sem</option>
  <option value="8th sem">8th sem</option>
</select>
<br><br>
<input type="text" name="skills" placeholder="enter skills" class="input" />
    <br><br>
    <button type="submit" class="btn btn-primary ">Register Student</button>
    </form>
</div>
@endsection