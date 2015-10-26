<?php
namespace Crowdsdom\Labor\Models\Base;

use Crowdsdom\Labor\Models\Model;

class JobType extends Model
{
    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var array */
    public $reward;

    /** @var array */
    public $keywords;

    /** @var number */
    public $taskDuration;

    /** @var number */
    public $lifetime;

    /** @var number */
    public $maxTasks;

    /** @var number */
    public $autoApprovalDelay;

    /** @var \DateTime */
    public $createdAt;

    /** @var \DateTime */
    public $updatedAt;

    /** @var string */
    public $ownerId;

    /** @var boolean */
    public $assignable;

}
