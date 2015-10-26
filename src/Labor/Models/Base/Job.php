<?php
namespace Crowdsdom\Labor\Models\Base;

use Crowdsdom\Labor\Models\Model;

class Job extends Model
{
    /** @var string */
    public $jobTypeId;

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var array */
    public $keywords;

    /** @var string */
    public $status;

    /** @var boolean */
    public $assignable;

    /** @var number */
    public $lifetime;

    /** @var number */
    public $taskDuration;

    /** @var number */
    public $maxTasks;

    /** @var number */
    public $autoApprovalDelay;

    /** @var \DateTime */
    public $expirationTime;

    /** @var string */
    public $questionsType;

    /** @var string */
    public $requesterAnnotation;

    /** @var string */
    public $reviewStatus;

    /** @var string */
    public $ownerId;

}
