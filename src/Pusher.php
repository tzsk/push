<?php

namespace Tzsk\Push;

use Gomoob\Pushwoosh\Model\Notification\Android;
use Gomoob\Pushwoosh\Model\Notification\IOS;
use Gomoob\Pushwoosh\Model\Notification\Notification;
use Gomoob\Pushwoosh\Model\Notification\Platform;
use Gomoob\Pushwoosh\Model\Request\CreateMessageRequest;
use Tzsk\Push\Factory\PusherFactory;

class Pusher
{
    /**
     * Title of the message.
     *
     * @var string
     */
    protected $title = "";

    /**
     * Body of the message.
     *
     * @var string
     */
    protected $body = "";

    /**
     * Badge of message.
     *
     * @var int
     */
    protected $badge = null;

    /**
     * Payload of the message.
     *
     * @var array
     */
    protected $payload = [];

    /**
     * Icon of the message.
     *
     * @var string
     */
    protected $icon = "";

    /**
     * Small Icon.
     *
     * @var null
     */
    protected $smallIcon = null;

    /**
     * Banner of the message.
     *
     * @var string
     */
    protected $banner = "";

    /**
     * Sond of the message.
     *
     * @var string
     */
    protected $sound = 'default';

    /**
     * Priority of the message.
     *
     * @var int
     */
    protected $priority = 1;

    /**
     * Vibration of the message.
     *
     * @var int
     */
    protected $vibration = 1;

    /**
     * Icon Background Color.
     * @var string
     */
    protected $ibc = "#ffffff";

    /**
     * Pushwoosh Instance.
     *
     * @var
     */
    protected $push;

    /**
     * Send to devices.
     *
     * @var array
     */
    protected $tokens = [];

    /**
     * PushWooshManager constructor.
     *
     * @param PusherFactory $factory
     */
    public function __construct(PusherFactory $factory)
    {
        $this->push = $factory->make();

        $this->icon = config('push.settings.icon');
        $this->title = config('push.settings.title');
        $this->body = config('push.settings.body');
        $this->vibration = config('push.settings.vibration');
        $this->sound = config('push.settings.sound');
        $this->priority = config('push.settings.priority');
        $this->ibc = config('push.settings.ibc');
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param mixed $badge
     * @return $this
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * @param mixed $payload
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @param mixed $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param mixed $smallIcon
     * @return $this
     */
    public function setSmallIcon($smallIcon)
    {
        $this->smallIcon = $smallIcon;

        return $this;
    }

    /**
     * @param mixed $banner
     * @return $this
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * @param string $sound
     * @return $this
     */
    public function setSound($sound)
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @param int $vibration
     * @return $this
     */
    public function setVibration($vibration)
    {
        $this->vibration = $vibration;

        return $this;
    }

    /**
     * @param string $ibc
     * @return $this
     */
    public function setIbc($ibc)
    {
        $this->ibc = $ibc;

        return $this;
    }

    /**
     * Set Device token.
     *
     * @param $token
     * @return $this
     */
    public function setToken($token) {
        $tokens = array_merge($this->tokens, [$token]);
        $this->tokens = $tokens;

        return $this;
    }

    /**
     * Set Device token array.
     * 
     * @param array $tokens
     * @return $this
     */
    public function setTokens(array $tokens) {
        $tokens = array_merge($this->tokens, $tokens);
        $this->tokens = $tokens;

        return $this;
    }

    /**
     * Get Android Settings.
     *
     * @return Android
     */
    protected function getAndroidSettings() {

        $android = Android::create()
            ->setBadges($this->badge)
            ->setIbc($this->ibc)
            ->setCustomIcon($this->icon)
            ->setHeader($this->title)
            ->setIcon($this->smallIcon)
            ->setPriority($this->priority)
            ->setSound($this->sound)
            ->setVibration($this->vibration);
        if ($this->banner) {
            $android->setBanner($this->banner);
        }

        return $android;
    }

    /**
     * Get IOS Settings.
     *
     * @return IOS
     */
    protected function getIosSettings() {
        $ios = IOS::create()->setBadges($this->badge);

        return $ios;
    }

    /**
     * @param $token
     * @return CreateMessageRequest
     */
    protected function getPushRequest($token)
    {
        $notification = Notification::create()
            ->setPlatforms([
                Platform::ios(),
                Platform::android(),
            ])
            ->setDevices($token)
            ->setIOS($this->getIosSettings())
            ->setAndroid($this->getAndroidSettings())
            ->setData($this->payload)
            ->setContent($this->body);
        $request = CreateMessageRequest::create()->addNotification($notification);

        return $request;
    }

    /**
     * Send Push to tokens.
     *
     * @return object
     */
    public function send($message, $callback) {
        $this->body = $message;
        
        call_user_func($callback, $this);

        $request = $this->getPushRequest($this->tokens);
        $response = $this->push->createMessage($request);

        return $response;
    }

}
