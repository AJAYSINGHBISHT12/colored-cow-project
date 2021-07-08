<?php

namespace Modules\HR\Entities\Evaluation;

use Illuminate\Database\Eloquent\Model;
use Modules\HR\Entities\Application;
use Modules\HR\Entities\ApplicationRound;

class ApplicationEvaluation extends Model
{
    protected $fillable = ['application_id', 'application_round_id', 'evaluation_id', 'option_id', 'comment'];

    protected $table = 'hr_application_evaluations';

    public function applicationRound()
    {
        return $this->belongsTo(ApplicationRound::class, 'application_round_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function evaluationParameter()
    {
        return $this->belongsTo(Parameter::class, 'evaluation_id');
    }

    public function evaluationOption()
    {
        return $this->belongsTo(ParameterOption::class, 'option_id');
    }
}
