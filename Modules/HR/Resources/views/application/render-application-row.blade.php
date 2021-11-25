<tr>
    <td class="w-25p">
        <div>
            <a href="/{{ Request::path() }}/{{ $application->id }}/edit"
                class="mr-1">{{ $application->applicant->name }}
            </a>
            <button class="assignlabels" title="Assign labels" data-toggle="modal" data-target="#assignlabelsmodal" type="button">{!! file_get_contents(public_path('icons/three-dots-vertical.svg')) !!}</button>

            @php
            $formData = $application->applicationMeta()->formData()->first();
            @endphp
            @if (isset($formData->value))
            @php
            $tooltipHtml = '';
            $index = 0;
            foreach (json_decode($formData->value) as $field => $value) {
            if (!$value) continue;
            $tooltipHtml .= "$field<br />";
            $tooltipHtml .= "$value\n\n";
            break;
            }
            @endphp
            @if ($tooltipHtml)
            <span class="mr-1">
                <i class="fa fa-eye" aria-hidden="true" class="text-secondary c-pointer" data-toggle="tooltip"
                    data-placement="top" data-html="true" title="{!! $tooltipHtml !!}"></i>
            </span>
            @endif
            @endif
        </div>
        @include('hr.application.assignlabels-modal')
        <div class="mb-2 fz-xl-14 text-secondary d-flex flex-column">
            <span class="mr-1 text-truncate">
                <i class="fa fa-envelope-o mr-1"></i>{{ $application->applicant->email }}</span>
            @if ($application->applicant->phone)
            <span class="mr-1"><i class="fa fa-phone mr-1"></i>{{ $application->applicant->phone }}</span>
            @endif
            @if ($application->applicant->college)
            <span class="mr-1"><i class="fa fa-university mr-1"></i>{{ $application->applicant->college }}</span>
            @endif
        </div>

        <div>
            @if ($application->applicant->linkedin)
            <a href="{{$application->applicant->linkedin}}" target="_blank" data-toggle="tooltip" data-placement="top"
                title="LinkedIn" class="mr-1 text-decoration-none">
                <span><i class="fa fa-linkedin-square" aria-hidden="true"></i></span>
            </a>
            @endif
            @if ($application->resume)
            <a href="{{$application->resume}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Resume"
                class="mr-1 text-decoration-none">
                <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
            </a>
            @endif
        </div>
    </td>
    <td>
        <div class="d-flex flex-column">
            <span>{{ $application->job->title }}</span>
            <span class="fz-xl-14 text-secondary">Applied on
                {{ $application->created_at->format(config('constants.display_date_format')) }}</span>
            <span class="font-weight-bold fz-xl-14 text-dark">
                <span><i class="fa fa-flag mr-1"></i>{{ $application->latestApplicationRound->round->isTrialRound()? optional($application->latestApplicationRound->trialRound)->name : $application->latestApplicationRound->round->name }}</span>
                @if ($application->latestApplicationRound->scheduled_date &&
                $application->latestApplicationRound->round->name != 'Resume Screening')
                <p class="ml-3">
                    {{ $application->latestApplicationRound->scheduled_date->format(config('constants.display_daydatetime_format')) }}
                </p>
                @endif
            </span>
        </div>
    </td>
    <td class="">
        @php
        $assignee = $application->latestApplicationRound->scheduledPerson;
        @endphp
        <img src="{{$assignee->avatar}}" alt="{{$assignee->name}}" class="w-25 h-25 rounded-circle"
            data-toggle="tooltip" data-placement="top" title="{{$assignee->name}}">
    </td>
    <td>
        <span class="d-flex flex-column align-items-start">
        @if (!in_array($application->status, ['in-progress', 'new']))
        <span
            class="{{ config("constants.hr.status.$application->status.class") }} badge-pill mr-1 mb-1 fz-12">{{ config("constants.hr.status.$application->status.title") }}</span>
        @endif
        @if (!$application->latestApplicationRound->scheduled_date)
        <span class="badge badge-theme-teal text-white badge-pill mr-1 mb-1 fz-12">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Awaiting confirmation</span>
            @php
            $awaitingForDays =
            $application->latestApplicationRound->getPreviousApplicationRound()->conducted_date->diffInDays(today());
            @endphp
            @if ($awaitingForDays)
            <span>• {{ $awaitingForDays == 1 ? 'day' : 'days' }} {{ $awaitingForDays }}</span>
            @endif
        </span>
        @endif
        @foreach ($application->tags as $tag)
        <span class="badge badge-pill mr-1 mb-1 fz-12 c-pointer"
            style="background-color: {{ $tag->background_color }};color: {{ $tag->text_color  }};" data-toggle="tooltip"
            data-placement="top" title="{{ $tag->description }}">
            @if ($tag->icon)
            {!! config("tags.icons.{$tag->icon}") !!}
            @endif
            <span>
                {{ $tag->name }}

                @if($tag->slug == 'need-follow-up' && $attampt =
                optional($application->latestApplicationRound->followUps)->count())
                . attempt: {{$attampt}}
                @endif

            </span>

        </span>
        @endforeach
        </span>
    </td>
</tr>