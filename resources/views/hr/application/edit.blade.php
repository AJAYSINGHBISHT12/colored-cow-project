@extends('layouts.app')

@section('content')
<div :class="[showResumeFrame ? 'container-fluid' : 'container']" id="page_hr_applicant_edit">
    <div class="row">
        <div class="col-md-12">
            <br>
            @includeWhen($type == 'volunteer', 'hr.volunteers.menu')
            @includeWhen($type == 'recruitment', 'hr.menu')
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            @include('hr.application.timeline', ['timeline' => $timeline, 'currentApplication' => $application])
        </div>
        <div v-bind:class="[showResumeFrame ? 'offset-md-2 col-md-7 pl-9' : 'col-md-8']">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <div>Applicant Details</div>
                            @foreach ($application->tags as $tag)
                                <div class="badge text-uppercase fz-xl-12 c-pointer" style="background-color: {{ $tag->background_color }};color: {{ $tag->text_color  }};" data-toggle="tooltip" data-placement="top" title="{{ $tag->description }}">
                                    @if ($tag->icon)
                                        {!! config("tags.icons.{$tag->icon}") !!}
                                    @endif
                                    {{ $tag->name }}
                                </div>
                            @endforeach
                            @if (!in_array($application->status, ['in-progress', 'new']))
                                <div class="{{ config("constants.hr.status.$application->status.class") }} text-uppercase card-status-highlight fz-12">
                                    {{ config("constants.hr.status.$application->status.title") }}
                                </div>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            <div class="mb-1">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customApplicationMail">Send mail</button>
                                @include('hr.custom-application-mail-modal', ['application' => $application])
                            </div>
                            <div class="text-right fz-14">
                                <span class="c-pointer btn-clipboard text-right" data-clipboard-text="{{ $application->getScheduleInterviewLink() }}" data-toggle="tooltip" title="Click to copy">
                                    <span class="mr-0.16">Interview Schedule link</span>
                                    <i class="fa fa-clone"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Name</label>
                            <div>
                                {{ $applicant->name }}
                                @if ($applicant->linkedin)
                                    <a href="{{ $applicant->linkedin }}" target="_blank"><i class="fa fa-linkedin-square pl-1 fa-lg"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group offset-md-1 col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Applied for</label>
                            <div>
                                <a href="{{ $application->job->link }}" target="_blank">
                                    <span>{{ $application->job->title }}</span>
                                    <i class="fa fa-external-link fz-14" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Phone</label>
                            <div>{{ $applicant->phone ?? '-' }}</div>
                        </div>
                        <div class="form-group offset-md-1 col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Email</label>
                            <div>{{ $applicant->email }}</div>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">College</label>
                            <div>{{ $applicant->college ?? '-' }}</div>
                        </div>
                        <div class="form-group offset-md-1 col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Course</label>
                            <div>{{ $applicant->course ?? '-' }}</div>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Resume</label>
                            <div>
                            @if ($application->resume)
                                @include('hr.application.inline-resume', ['resume' => $application->resume])
                            @else
                                –
                            @endif
                            </div>
                        </div>
                        <div class="form-group offset-md-1 col-md-5">
                            <label class="text-secondary fz-14 leading-none mb-0.16">Graduation Year</label>
                            <div>
                                {{ $applicant->graduation_year ?? '-' }}&nbsp;
                                @includeWhen(isset($hasGraduated) && !$hasGraduated, 'hr.job-to-internship-modal', ['application' => $application])
                            </div>
                        </div>
                        @if (isset($applicationFormDetails->value))
                            @foreach(json_decode($applicationFormDetails->value) as $field => $value)
                                <div class="form-group col-md-12">
                                    <label class="text-secondary fz-14 leading-none mb-0.16">{{ $field }}</label>
                                    <div>{{ $value }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                @if(sizeOf($application->trialApplicationRounds))
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link {{ $application->latestApplicationRound->round->name == 'Trial Program' ? 'active' : '' }}" id="nav-trial-tab" data-toggle="tab" href="#nav-trial" role="tab" aria-controls="nav-trial" aria-selected="true">Trial</a>
                        <a class="nav-item nav-link {{ $application->latestApplicationRound->round->name == 'Trial Program' ? '' : 'active' }}" id="nav-pre-trial-tab" data-toggle="tab" href="#nav-pre-trial" role="tab" aria-controls="nav-pre-trial" aria-selected="false">Pre-Trial</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ $application->latestApplicationRound->round->name == 'Trial Program' ? 'show active' : '' }}" id="nav-trial" role="tabpanel" aria-labelledby="nav-trial-tab">               
                            @foreach ($application->trialApplicationRounds as $applicationRound)
                                @php
                                    $applicationRoundReview = $applicationRound->applicationRoundReviews->where('review_key', 'feedback')->first();
                                    $applicationRoundReviewValue = $applicationRoundReview ? $applicationRoundReview->review_value : '';
                                @endphp
                                <br>
                                @if(sizeof($applicationRound->followUps))
                                    <div class="my-2">
                                    @foreach($applicationRound->followUps as $followUp)
                                        <div class="d-flex align-items-center mb-1.5">
                                            <i class="fa fa-clock-o fz-20 mr-1" aria-hidden="true"></i>
                                            <span class="fz-14 leading-none">
                                                <span class="mr-0.5">Followed up by</span>
                                                <img src="{{ $followUp->conductedBy->avatar }}" class="w-20 h-20 rounded-circle mr-0.5" data-toggle="tooltip" title="{{ $followUp->conductedBy->name }}">
                                                <span class="mr-1.5">on {{ $followUp->created_at->format(config('constants.full_display_date_format')) }}</span>
                                                <a href="#" data-toggle="modal" data-target="#followUp{{$followUp->id}}">View feedback</a>
                                                @include('hr::follow-up.modal')
                                            </span>
                                        </div>
                                    @endforeach
                                    </div>
                                @endif
                                @if ($loop->last && $applicationRound->application->hasTag('need-follow-up'))
                                    <div class="d-flex justify-content-start">
                                        <button type="button" class="btn btn-sm btn-info fz-14 leading-none text-white rounded-0 py-1" data-toggle="modal" data-target="#followUpModal">Follow up</button>
                                    </div>
                                    @include('hr.application.follow-up-modal')
                                @endif
                                <div class="card mx-2 mb-2">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div>
                                                {{$applicationRound->trialRound->name }}
                                                <span title="{{ $applicationRound->round->name }} guide" class="modal-toggler-text text-muted" data-toggle="modal" data-target="#round_guide_{{ $applicationRound->round->id }}">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </span>
                                            </div>
                                            @if ($applicationRound->round_status)
                                                <span>Conducted By: {{ $applicationRound->conductedPerson->name }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column align-items-end">
                                                @if ($applicationRound->noShow && $applicationRound->round->reminder_enabled)
                                                    <span class="text-danger"><i class="fa fa-warning fa-lg"></i>&nbsp;{{ config('constants.hr.status.no-show-reminded.title') }}</span>
                                                @endif
                            
                                                @if ($applicationRound->round_status === config('constants.hr.status.confirmed.label'))
                                                    <div class="text-success"><i class="fa fa-check"></i>&nbsp;{{ config('constants.hr.status.confirmed.title') }}</div>
                                                @elseif ($applicationRound->round_status == config('constants.hr.status.rejected.label'))
                                                    <div class="text-danger"><i class="fa fa-close"></i>&nbsp;{{ config('constants.hr.status.rejected.title') }}</div>
                                                @endif
                                                @if ($applicationRound->round_status && $applicationRound->conducted_date)
                                                    <span>Conducted on: {{ $applicationRound->conducted_date->format(config('constants.display_date_format')) }}</span>
                                                @endif
                                            </div>
                                            <div class="icon-pencil position-relative ml-3" data-toggle="collapse" data-target="#collapse_{{ $loop->iteration }}"><i class="fa fa-pencil"></i></div>
                                        </div>
                                    </div>
                                    @if($application->latestApplicationRound->round->name == 'Trial Program')
                                        <form action="/hr/applications/rounds/{{ $applicationRound->id }}" method="POST" enctype="multipart/form-data" class="applicant-round-form">
                                
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div id="collapse_{{ $loop->iteration }}" class="collapse {{ $loop->last ? 'show' : '' }}">
                                                <div class="card-body">
                                                    @if ( !$applicationRound->round_status)
                                                        <div class="form-row">
                                                            <div class="form-group col-md-5">
                                                                <label for="scheduled_date" class="fz-14 leading-none text-secondary w-100p">
                                                                    <div>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    <span>Scheduled date</span>
                                                                        @if($applicationRound->scheduled_date)
                                                                            @if($applicationRound->hangout_link)
                                                                                <a target="_blank" class="ml-5 font-muli-bold" href="{{ $applicationRound->hangout_link }}">
                                                                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                                                    <span>Meeting Link</span>
                                                                                </a>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </label>
                                                                @if ($applicationRound->scheduled_date)
                                                                    <input type="datetime-local" 
                                                                        name="scheduled_date" id="scheduled_date" 
                                                                        class="form-control form-control-sm" 
                                                                        value="{{ $applicationRound->scheduled_date->format(config('constants.display_datetime_format')) }}">
                                                                @else
                                                                    <div class="fz-16 leading-tight">Pending calendar confirmation</div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="scheduled_person_id" class="fz-14 leading-none text-secondary">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                    <span>Scheduled for</span>
                                                                </label>
                                                                @if ($applicationRound->scheduled_date)
                                                                    <select name="scheduled_person_id" id="scheduled_person_id" class="form-control form-control-sm" >
                                                                        @foreach ($interviewers as $interviewer)
                                                                            @php
                                                                                $selected = $applicationRound->scheduled_person_id == $interviewer->id ? 'selected="selected"' : '';
                                                                            @endphp
                                                                            <option value="{{ $interviewer->id }}" {{ $selected }}>
                                                                                {{ $interviewer->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <div class="fz-16 leading-tight">
                                                                        <img src="{{ $applicationRound->scheduledPerson->avatar }}" alt="{{ $applicationRound->scheduledPerson->name }}" class="w-25 h-25 rounded-circle">
                                                                        <span>{{ $applicationRound->scheduledPerson->name }}</span>
                                                                    </div>
                                                                @endif
                                                                
                                                            </div>
                                                            @if ($applicationRound->scheduled_date)
                                                                <div class="form-group col-md-3 d-flex align-items-end">
                                                                <button type="button" class="py-1 mb-0 btn btn-info btn-sm round-submit update-schedule" data-action="schedule-update">Update Schedule</button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    @if($application->latestApplicationRound->round->name == 'Trial Program')
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <button type="button" class="btn btn-theme-fog btn-sm" @click="getApplicationEvaluation({{ $applicationRound->id }})">Application Evaluation</button>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            @php
                                                                if ($loop->last && sizeOf($errors)) {
                                                                    $applicationRoundReviewValue = old('reviews.feedback');
                                                                }
                                                            @endphp
                                                            <textarea name="reviews[{{ $applicationRound->id }}][feedback]" id="reviews[{{ $applicationRound->id }}][feedback]" rows="6" class="form-control" placeholder="Enter comments...">{{ $applicationRoundReviewValue }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row d-flex justify-content-end">
                                                        <button type="button" class="btn btn-info btn-sm round-submit" data-action="update">Update feedback</button>
                                                    </div>
                                                @endif
                                                </div>
                                                @php
                                                    $showFooter = false;
                                                    if ($loop->last) {
                                                        if (in_array($applicationRound->application->status, [config('constants.hr.status.sent-for-approval.label'), 
                                                        config('constants.hr.status.approved.label')])) {
                                                            $showFooter = true;
                                                        }
                                                        elseif (in_array($applicationRound->round_status, [null, config('constants.hr.status.rejected.label')])) {
                                                            $showFooter = true;
                                                        }
                                                    }
                                                    elseif (!$applicationRound->mail_sent) {
                                                        $showFooter = true;
                                                    }
                                                @endphp
                                                @if ($showFooter)
                                                <div class="card-footer">
                                                    <div class="d-flex align-items-center">
                                                    @if ($applicationRound->showActions)
                                                        <select name="action_type" id="action_type" 
                                                        class="form-control w-50p" v-on:change="onSelectNextRound($event)" 
                                                        data-application-job-rounds="{{ json_encode($application->job->trialRounds) }}">
                                                            <option v-for="round in applicationJobRounds" value="round" 
                                                            :data-next-round-id="round.id">Move to @{{ round.name }}</option>
                                                            <option value="send-for-approval">Send for approval</option>
                                                            <option value="approve">Approve</option>
                                                            <option value="onboard">Onboard</option>
                                                        </select>
                                                        <button type="button" class="btn btn-success ml-2" @click="takeAction()">Take action</button>
                                                    @endif
                                                    @if ($loop->last && !$application->isRejected())
                                                        {{-- @if ($applicantOpenApplications->count() > 1) --}}
                                                            <button type="button" class="btn btn-outline-danger ml-2" id="rejectApplication" @click="rejectApplication()">Reject</button>
                                                            @include('hr.application.rejection-modal', ['currentApplication' => $application, 'allApplications' => $applicantOpenApplications ])
                                                        {{-- @else --}}
                                                            {{-- <button type="button" class="btn btn-outline-danger ml-2 round-submit" data-action="reject" data-toggle="modal" data-target="#application_reject_modal">Reject</button> --}}
                                                        {{-- @endif --}}
                                                    @endif
                                                    @if (!is_null($applicationRound->round_status) && !$applicationRound->mail_sent)
                                                        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#round_{{ $applicationRound->id }}">Send mail</button>
                                                    @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <input type="hidden" name="action" value="updated">
                                            <input type="hidden" name="next_round" value="">
                                            @if ($loop->last)
                                                <input type="hidden" name="current_applicationround_id" id="current_applicationround_id" value="{{ $applicationRound->id }}">
                                            @endif
                                            @includeWhen($applicationRound->showActions, 'hr.round-review-confirm-modal', 
                                            ['applicationRound' => $applicationRound])
                                            @includeWhen($loop->last, 'hr.application.send-for-approval-modal')
                                            @includeWhen($loop->last, 'hr.application.onboard-applicant-modal')
                                            @includeWhen($loop->last, 'hr.application.approve-applicant-modal')
                                        </form>
                                    @endif
                                </div>
                                @include('hr.round-guide-modal', ['round' => $applicationRound->round])
                                @includeWhen($applicationRound->round_status && !$applicationRound->mail_sent, 'hr.round-review-mail-modal', ['applicantRound' => $applicationRound])
                                @include('hr.application.application-evaluation', ['round' => $applicationRound->trialRound])
                            @endforeach
                        </div>
                        <div class="tab-pane fade {{ $application->latestApplicationRound->round->name == 'Trial Program' ? '' : 'show active' }}" id="nav-pre-trial" role="tabpanel" aria-labelledby="nav-pre-trial-tab">
                            @foreach ($application->applicationRounds as $applicationRound)
                                @php
                                    $applicationRoundReview = $applicationRound->applicationRoundReviews->where('review_key', 'feedback')->first();
                                    $applicationRoundReviewValue = $applicationRoundReview ? $applicationRoundReview->review_value : '';
                                @endphp
                                <br>
                                @if(sizeof($applicationRound->followUps))
                                    <div class="mt-3">
                                        @foreach($applicationRound->followUps as $followUp)
                                            <div class="d-flex align-items-center mb-1.5">
                                                <i class="fa fa-clock-o fz-20 mr-1" aria-hidden="true"></i>
                                                <span class="fz-14 leading-none">
                                                    <span class="mr-0.5">Followed up by</span>
                                                    <img src="{{ $followUp->conductedBy->avatar }}" class="w-20 h-20 rounded-circle mr-0.5" data-toggle="tooltip" title="{{ $followUp->conductedBy->name }}">
                                                    <span class="mr-1.5">on {{ $followUp->created_at->format(config('constants.full_display_date_format')) }}</span>
                                                    <a href="#" data-toggle="modal" data-target="#followUp{{$followUp->id}}">View feedback</a>
                                                    @include('hr::follow-up.modal')
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($loop->last && $applicationRound->application->hasTag('need-follow-up'))
                                    <div class="d-flex justify-content-start">
                                        <button type="button" class="btn btn-sm btn-info fz-14 leading-none text-white rounded-0 py-1" data-toggle="modal" data-target="#followUpModal">Follow up</button>
                                    </div>
                                    @include('hr.application.follow-up-modal')
                                @endif
                                <div class="card mx-2 mb-2">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div>
                                                {{ $applicationRound->round->name }}
                                                <span title="{{ $applicationRound->round->name }} guide" class="modal-toggler-text text-muted" data-toggle="modal" data-target="#round_guide_{{ $applicationRound->round->id }}">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </span>
                                            </div>
                                            @if ($applicationRound->round_status)
                                                <span>Conducted By: {{ $applicationRound->conductedPerson->name }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column align-items-end">
                                                @if ($applicationRound->noShow && $applicationRound->round->reminder_enabled)
                                                    <span class="text-danger"><i class="fa fa-warning fa-lg"></i>&nbsp;{{ config('constants.hr.status.no-show-reminded.title') }}</span>
                                                @endif
                            
                                                @if ($applicationRound->round_status === config('constants.hr.status.confirmed.label'))
                                                    <div class="text-success"><i class="fa fa-check"></i>&nbsp;{{ config('constants.hr.status.confirmed.title') }}</div>
                                                @elseif ($applicationRound->round_status == config('constants.hr.status.rejected.label'))
                                                    <div class="text-danger"><i class="fa fa-close"></i>&nbsp;{{ config('constants.hr.status.rejected.title') }}</div>
                                                @endif
                                                @if ($applicationRound->round_status && $applicationRound->conducted_date)
                                                    <span>Conducted on: {{ $applicationRound->conducted_date->format(config('constants.display_date_format')) }}</span>
                                                @endif
                                            </div>
                                            <div class="icon-pencil position-relative ml-3" data-toggle="collapse" data-target="#pre-trial-collapse_{{ $loop->iteration }}"><i class="fa fa-pencil"></i></div>
                                        </div>
                                    </div>
                                        <form action="/hr/applications/rounds/{{ $applicationRound->id }}" method="POST" enctype="multipart/form-data" class="applicant-round-form">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div id="pre-trial-collapse_{{ $loop->iteration }}" class="collapse">
                                                <div class="card-body">
                                                    @if ( !$applicationRound->round_status)
                                                        <div class="form-row">
                                                            <div class="form-group col-md-5">
                                                                <label for="scheduled_date" class="fz-14 leading-none text-secondary w-100p">
                                                                    <div>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    <span>Scheduled date</span>
                                                                        @if($applicationRound->scheduled_date)
                                                                            @if($applicationRound->hangout_link)
                                                                                <a target="_blank" class="ml-5 font-muli-bold" href="{{ $applicationRound->hangout_link }}">
                                                                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                                                    <span>Meeting Link</span>
                                                                                </a>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </label>
                                                                @if ($applicationRound->scheduled_date)
                                                                    <input type="datetime-local" 
                                                                        name="scheduled_date" id="scheduled_date" 
                                                                        class="form-control form-control-sm" 
                                                                        value="{{ $applicationRound->scheduled_date->format(config('constants.display_datetime_format')) }}">
                                                                @else
                                                                    <div class="fz-16 leading-tight">Pending calendar confirmation</div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="scheduled_person_id" class="fz-14 leading-none text-secondary">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                    <span>Scheduled for</span>
                                                                </label>
                                                                @if ($applicationRound->scheduled_date)
                                                                    <select name="scheduled_person_id" id="scheduled_person_id" class="form-control form-control-sm" >
                                                                        @foreach ($interviewers as $interviewer)
                                                                            @php
                                                                                $selected = $applicationRound->scheduled_person_id == $interviewer->id ? 'selected="selected"' : '';
                                                                            @endphp
                                                                            <option value="{{ $interviewer->id }}" {{ $selected }}>
                                                                                {{ $interviewer->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <div class="fz-16 leading-tight">
                                                                        <img src="{{ $applicationRound->scheduledPerson->avatar }}" alt="{{ $applicationRound->scheduledPerson->name }}" class="w-25 h-25 rounded-circle">
                                                                        <span>{{ $applicationRound->scheduledPerson->name }}</span>
                                                                    </div>
                                                                @endif
                                                                
                                                            </div>
                                                            @if ($applicationRound->scheduled_date)
                                                                <div class="form-group col-md-3 d-flex align-items-end">
                                                                <button type="button" class="py-1 mb-0 btn btn-info btn-sm round-submit update-schedule" data-action="schedule-update">Update Schedule</button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    @endif                     
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <button type="button" class="btn btn-theme-fog btn-sm" @click="getApplicationEvaluation({{ $applicationRound->id }})">Application Evaluation</button>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            @php
                                                                if ($loop->last && sizeOf($errors)) {
                                                                    $applicationRoundReviewValue = old('reviews.feedback');
                                                                }
                                                            @endphp
                                                            <textarea name="reviews[{{ $applicationRound->id }}][feedback]" id="reviews[{{ $applicationRound->id }}][feedback]" rows="6" class="form-control" placeholder="Enter comments...">{{ $applicationRoundReviewValue }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row d-flex justify-content-end">
                                                        <button type="button" class="btn btn-info btn-sm round-submit" data-action="update">Update feedback</button>
                                                    </div>
                                                </div>
                                                @if($application->latestApplicationRound->round->name == 'Trial Program')
                                                    @php
                                                        $showFooter = false;
                                                        if ($loop->last) {
                                                            if (in_array($applicationRound->application->status, [config('constants.hr.status.sent-for-approval.label'), 
                                                            config('constants.hr.status.approved.label')])) {
                                                                $showFooter = true;
                                                            }
                                                            elseif (in_array($applicationRound->round_status, [null, config('constants.hr.status.rejected.label')])) {
                                                                $showFooter = true;
                                                            }
                                                        }
                                                        elseif (!$applicationRound->mail_sent) {
                                                            $showFooter = true;
                                                        }
                                                    @endphp
                                                    @if ($showFooter)
                                                    <div class="card-footer">
                                                        <div class="d-flex align-items-center">
                                                        @if ($applicationRound->showActions)
                                                            <select name="action_type" id="action_type" 
                                                            class="form-control w-50p" v-on:change="onSelectNextRound($event)" 
                                                            data-application-job-rounds="{{ json_encode($application->job->rounds) }}">
                                                                <option v-for="round in applicationJobRounds" value="round" 
                                                                :data-next-round-id="round.id">Move to @{{ round.name }}</option>
                                                                <option value="send-for-approval">Send for approval</option>
                                                                <option value="approve">Approve</option>
                                                                <option value="onboard">Onboard</option>
                                                            </select>
                                                            <button type="button" class="btn btn-success ml-2" @click="takeAction()">Take action</button>
                                                        @endif
                                                        @if ($loop->last && !$application->isRejected())
                                                            {{-- @if ($applicantOpenApplications->count() > 1) --}}
                                                                <button type="button" class="btn btn-outline-danger ml-2" id="rejectApplication" @click="rejectApplication()">Reject</button>
                                                                @include('hr.application.rejection-modal', ['currentApplication' => $application, 'allApplications' => $applicantOpenApplications ])
                                                            {{-- @else --}}
                                                                {{-- <button type="button" class="btn btn-outline-danger ml-2 round-submit" data-action="reject" data-toggle="modal" data-target="#application_reject_modal">Reject</button> --}}
                                                            {{-- @endif --}}
                                                        @endif
                                                        @if (!is_null($applicationRound->round_status) && !$applicationRound->mail_sent)
                                                            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#round_{{ $applicationRound->id }}">Send mail</button>
                                                        @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if($application->latestApplicationRound->round->name == 'Trial Program')
                                                <input type="hidden" name="action" value="updated">
                                                <input type="hidden" name="next_round" value="">
                                                @if ($loop->last)
                                                    <input type="hidden" name="current_applicationround_id" id="current_applicationround_id" value="{{ $applicationRound->id }}">
                                                @endif
                                                @includeWhen($applicationRound->showActions, 'hr.round-review-confirm-modal', 
                                                ['applicationRound' => $applicationRound])
                                                @includeWhen($loop->last, 'hr.application.send-for-approval-modal')
                                                @includeWhen($loop->last, 'hr.application.onboard-applicant-modal')
                                                @includeWhen($loop->last, 'hr.application.approve-applicant-modal')
                                            @endif
                                        </form>  
                                   
                                    @endif               
                                </div>
                                @include('hr.round-guide-modal', ['round' => $applicationRound->round])
                                @includeWhen($applicationRound->round_status && !$applicationRound->mail_sent, 'hr.round-review-mail-modal', ['applicantRound' => $applicationRound])
                                @include('hr.application.application-evaluation', ['round' => $applicationRound->round])
                            @endforeach
                        </div>
                    </div>
                @else
                    @foreach ($application->applicationRounds as $applicationRound)
                        @php
                            $applicationRoundReview = $applicationRound->applicationRoundReviews->where('review_key', 'feedback')->first();
                            $applicationRoundReviewValue = $applicationRoundReview ? $applicationRoundReview->review_value : '';
                        @endphp
                        <br>
                        @if(sizeof($applicationRound->followUps))
                            <div class="mt-3">
                            @foreach($applicationRound->followUps as $followUp)
                                    <div class="d-flex align-items-center mb-1.5">
                                        <i class="fa fa-clock-o fz-20 mr-1" aria-hidden="true"></i>
                                        <span class="fz-14 leading-none">
                                            <span class="mr-0.5">Followed up by</span>
                                            <img src="{{ $followUp->conductedBy->avatar }}" class="w-20 h-20 rounded-circle mr-0.5" data-toggle="tooltip" title="{{ $followUp->conductedBy->name }}">
                                            <span class="mr-1.5">on {{ $followUp->created_at->format(config('constants.full_display_date_format')) }}</span>
                                            <a href="#" data-toggle="modal" data-target="#followUp{{$followUp->id}}">View feedback</a>
                                            @include('hr::follow-up.modal')
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if ($loop->last && $applicationRound->application->hasTag('need-follow-up'))
                            <div class="d-flex justify-content-start">
                                <button type="button" class="btn btn-sm btn-info fz-14 leading-none text-white rounded-0 py-1" data-toggle="modal" data-target="#followUpModal">Follow up</button>
                            </div>
                            @include('hr.application.follow-up-modal')
                        @endif
                        <div class="card mx-2 mb-2">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column">
                                    <div>
                                        {{ $applicationRound->round->name }}
                                        <span title="{{ $applicationRound->round->name }} guide" class="modal-toggler-text text-muted" data-toggle="modal" data-target="#round_guide_{{ $applicationRound->round->id }}">
                                            <i class="fa fa-info-circle fa-lg"></i>
                                        </span>
                                    </div>
                                    @if ($applicationRound->round_status)
                                        <span>Conducted By: {{ $applicationRound->conductedPerson->name }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column align-items-end">
                                        @if ($applicationRound->noShow && $applicationRound->round->reminder_enabled)
                                            <span class="text-danger"><i class="fa fa-warning fa-lg"></i>&nbsp;{{ config('constants.hr.status.no-show-reminded.title') }}</span>
                                        @endif
                    
                                        @if ($applicationRound->round_status === config('constants.hr.status.confirmed.label'))
                                            <div class="text-success"><i class="fa fa-check"></i>&nbsp;{{ config('constants.hr.status.confirmed.title') }}</div>
                                        @elseif ($applicationRound->round_status == config('constants.hr.status.rejected.label'))
                                            <div class="text-danger"><i class="fa fa-close"></i>&nbsp;{{ config('constants.hr.status.rejected.title') }}</div>
                                        @endif
                                        @if ($applicationRound->round_status && $applicationRound->conducted_date)
                                            <span>Conducted on: {{ $applicationRound->conducted_date->format(config('constants.display_date_format')) }}</span>
                                        @endif
                                    </div>
                                    <div class="icon-pencil position-relative ml-3" data-toggle="collapse" data-target="#collapse_{{ $loop->iteration }}"><i class="fa fa-pencil"></i></div>
                                </div>
                            </div>
                            @if($application->latestApplicationRound->round->name != 'Trial Program')
                                <form action="/hr/applications/rounds/{{ $applicationRound->id }}" method="POST" enctype="multipart/form-data" class="applicant-round-form">
                        
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div id="collapse_{{ $loop->iteration }}" class="collapse {{ $loop->last ? 'show' : '' }}">
                                        <div class="card-body">
                                            @if ( !$applicationRound->round_status)
                                                <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                        <label for="scheduled_date" class="fz-14 leading-none text-secondary w-100p">
                                                            <div>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            <span>Scheduled date</span>
                                                                @if($applicationRound->scheduled_date)
                                                                    @if($applicationRound->hangout_link)
                                                                        <a target="_blank" class="ml-5 font-muli-bold" href="{{ $applicationRound->hangout_link }}">
                                                                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                                            <span>Meeting Link</span>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </label>
                                                        @if ($applicationRound->scheduled_date)
                                                            <input type="datetime-local" 
                                                                name="scheduled_date" id="scheduled_date" 
                                                                class="form-control form-control-sm" 
                                                                value="{{ $applicationRound->scheduled_date->format(config('constants.display_datetime_format')) }}">
                                                        @else
                                                            <div class="fz-16 leading-tight">Pending calendar confirmation</div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="scheduled_person_id" class="fz-14 leading-none text-secondary">
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                            <span>Scheduled for</span>
                                                        </label>
                                                        @if ($applicationRound->scheduled_date)
                                                            <select name="scheduled_person_id" id="scheduled_person_id" class="form-control form-control-sm" >
                                                                @foreach ($interviewers as $interviewer)
                                                                    @php
                                                                        $selected = $applicationRound->scheduled_person_id == $interviewer->id ? 'selected="selected"' : '';
                                                                    @endphp
                                                                    <option value="{{ $interviewer->id }}" {{ $selected }}>
                                                                        {{ $interviewer->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <div class="fz-16 leading-tight">
                                                                <img src="{{ $applicationRound->scheduledPerson->avatar }}" alt="{{ $applicationRound->scheduledPerson->name }}" class="w-25 h-25 rounded-circle">
                                                                <span>{{ $applicationRound->scheduledPerson->name }}</span>
                                                            </div>
                                                        @endif
                                                        
                                                    </div>
                                                    @if ($applicationRound->scheduled_date)
                                                        <div class="form-group col-md-3 d-flex align-items-end">
                                                        <button type="button" class="py-1 mb-0 btn btn-info btn-sm round-submit update-schedule" data-action="schedule-update">Update Schedule</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif                     
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <button type="button" class="btn btn-theme-fog btn-sm" @click="getApplicationEvaluation({{ $applicationRound->id }})">Application Evaluation</button>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    @php
                                                        if ($loop->last && sizeOf($errors)) {
                                                            $applicationRoundReviewValue = old('reviews.feedback');
                                                        }
                                                    @endphp
                                                    <textarea name="reviews[{{ $applicationRound->id }}][feedback]" id="reviews[{{ $applicationRound->id }}][feedback]" rows="6" class="form-control" placeholder="Enter comments...">{{ $applicationRoundReviewValue }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex justify-content-end">
                                                <button type="button" class="btn btn-info btn-sm round-submit" data-action="update">Update feedback</button>
                                            </div>
                                        </div>
                                        @php
                                            $showFooter = false;
                                            if ($loop->last) {
                                                if (in_array($applicationRound->application->status, [config('constants.hr.status.sent-for-approval.label'), 
                                                config('constants.hr.status.approved.label')])) {
                                                    $showFooter = true;
                                                }
                                                elseif (in_array($applicationRound->round_status, [null, config('constants.hr.status.rejected.label')])) {
                                                    $showFooter = true;
                                                }
                                            }
                                            elseif (!$applicationRound->mail_sent) {
                                                $showFooter = true;
                                            }
                                        @endphp
                                        @if ($showFooter)
                                        <div class="card-footer">
                                            <div class="d-flex align-items-center">
                                            @if ($applicationRound->showActions)
                                                <select name="action_type" id="action_type" 
                                                class="form-control w-50p" v-on:change="onSelectNextRound($event)" 
                                                data-application-job-rounds="{{ json_encode($application->job->rounds) }}">
                                                    <option v-for="round in applicationJobRounds" value="round" 
                                                    :data-next-round-id="round.id">Move to @{{ round.name }}</option>
                                                    <option value="send-for-approval">Send for approval</option>
                                                    <option value="approve">Approve</option>
                                                    <option value="onboard">Onboard</option>
                                                </select>
                                                <button type="button" class="btn btn-success ml-2" @click="takeAction()">Take action</button>
                                            @endif
                                            @if ($loop->last && !$application->isRejected())
                                                {{-- @if ($applicantOpenApplications->count() > 1) --}}
                                                    <button type="button" class="btn btn-outline-danger ml-2" id="rejectApplication" @click="rejectApplication()">Reject</button>
                                                    @include('hr.application.rejection-modal', ['currentApplication' => $application, 'allApplications' => $applicantOpenApplications ])
                                                {{-- @else --}}
                                                    {{-- <button type="button" class="btn btn-outline-danger ml-2 round-submit" data-action="reject" data-toggle="modal" data-target="#application_reject_modal">Reject</button> --}}
                                                {{-- @endif --}}
                                            @endif
                                            @if (!is_null($applicationRound->round_status) && !$applicationRound->mail_sent)
                                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#round_{{ $applicationRound->id }}">Send mail</button>
                                            @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="action" value="updated">
                                    <input type="hidden" name="next_round" value="">
                                    @if ($loop->last)
                                        <input type="hidden" name="current_applicationround_id" id="current_applicationround_id" value="{{ $applicationRound->id }}">
                                    @endif
                                    @includeWhen($applicationRound->showActions, 'hr.round-review-confirm-modal', 
                                    ['applicationRound' => $applicationRound])
                                    @includeWhen($loop->last, 'hr.application.send-for-approval-modal')
                                    @includeWhen($loop->last, 'hr.application.onboard-applicant-modal')
                                    @includeWhen($loop->last, 'hr.application.approve-applicant-modal')
                                </form>
                            @endif
                        </div>
                        @include('hr.round-guide-modal', ['round' => $applicationRound->round])
                        @includeWhen($applicationRound->round_status && !$applicationRound->mail_sent, 'hr.round-review-mail-modal', ['applicantRound' => $applicationRound])
                        @include('hr.application.application-evaluation', ['round' => $applicationRound->round])
                    @endforeach
                @endif
            </div>          
        </div>
    </div>
</div>
@endsection
