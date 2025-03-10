<?php

namespace App\Notifications;

use App\Models\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FineTuningCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Dataset yang telah selesai di-fine-tune.
     *
     * @var \App\Models\Dataset
     */
    protected $dataset;

    /**
     * Apakah fine-tuning gagal.
     *
     * @var bool
     */
    protected $isFailed;

    /**
     * Pesan error jika gagal.
     *
     * @var string|null
     */
    protected $errorMessage;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Dataset  $dataset
     * @param  bool  $isFailed
     * @param  string|null  $errorMessage
     * @return void
     */
    public function __construct(Dataset $dataset, $isFailed = false, $errorMessage = null)
    {
        $this->dataset = $dataset;
        $this->isFailed = $isFailed;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject($this->getSubject());

        if ($this->isFailed) {
            $message->line('Kami ingin memberitahu bahwa proses fine-tuning untuk dataset "'.$this->dataset->name.'" telah gagal.')
                ->line('Alasan: ' . $this->errorMessage)
                ->action('Lihat Detail', url('/admin/fine-tuning'));
        } else {
            $message->line('Kami ingin memberitahu bahwa proses fine-tuning untuk dataset "'.$this->dataset->name.'" telah selesai.')
                ->line('Model AI Anda telah berhasil dilatih dan siap digunakan.')
                ->action('Lihat Hasil', url('/admin/fine-tuning'))
                ->line('Terima kasih telah menggunakan aplikasi kami!');
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $data = [
            'dataset_id' => $this->dataset->id,
            'dataset_name' => $this->dataset->name,
            'status' => $this->dataset->status,
            'is_failed' => $this->isFailed,
        ];

        if ($this->isFailed) {
            $data['error_message'] = $this->errorMessage;
        } else {
            $data['result_data'] = $this->dataset->result_data;
        }

        return $data;
    }

    /**
     * Get the subject of the notification.
     *
     * @return string
     */
    protected function getSubject()
    {
        if ($this->isFailed) {
            return 'Fine-tuning Gagal: ' . $this->dataset->name;
        }

        return 'Fine-tuning Selesai: ' . $this->dataset->name;
    }
} 