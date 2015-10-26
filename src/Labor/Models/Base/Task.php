<?php
namespace Crowdsdom\Labor\Models\Base;

class Task extends Model
{
    /** @var string */
    public $status;

    /** @var \DateTime */
    public $autoApprovalTime;

    /** @var \DateTime */
    public $acceptTime;

    /** @var \DateTime */
    public $submitTime;

    /** @var \DateTime */
    public $approvalTime;

    /** @var \DateTime */
    public $rejectionTime;

    /** @var \DateTime */
    public $expirationTime;

    /** @var string */
    public $requesterFeedback;

    /** @var string */
    public $jobId;

    /** @var string */
    public $contributorId;

    /** @var array */
    public $answers;

}
