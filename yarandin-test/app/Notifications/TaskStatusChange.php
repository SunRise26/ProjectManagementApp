<?php

namespace App\Notifications;

use App\Models\TaskStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusChange extends Notification
{
    use Queueable;

    public $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $task = $this->task;
        $taskStasuses = TaskStatus::all()->keyBy('id');
        $newStatusId = $task->status_id;
        $oldStatusId = $task->getOriginal('status_id');

        $newStatusTitle = $taskStasuses->get($newStatusId)->getTranslatedTitle();
        $oldStatusTitle = $taskStasuses->get($oldStatusId)->getTranslatedTitle(true);

        return (new MailMessage)
            ->line("(id: $task->id) \"$task->title\"")
            ->line("Status has changed: $oldStatusTitle -> $newStatusTitle")
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
