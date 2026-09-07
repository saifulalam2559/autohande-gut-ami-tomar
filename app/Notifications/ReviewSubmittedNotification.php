<?php


namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Review;

class ReviewSubmittedNotification extends Notification
{
    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['mail']; // Or add 'database' to store notifications in the database
    }

    public function toMail($notifiable)
    {
        
        // Determine the product URL based on the category
            $product = $this->review->product;
            $category = $product->subcategory->name; // Assuming 'name' is a field in the category model

            if ($category === 'Dessous, Nacht- & Lounge-Wäsche') {
                $productUrl = route('FrontendHoeschenDetailPageSlug', $product->slug);
            } elseif ($category === 'Socken & Strümpfe') {
                $productUrl = route('FrontendSockenDetailPageSlug', $product->slug);
            } elseif ($category === 'Activewear') {
                $productUrl = route('FrontendActivewearDetailPageSlug', $product->slug);
            } else {
                $productUrl = url('/'); // Default URL if no category match
            }
    
    
        return (new MailMessage)
                   ->subject('Neue Bewertung eingereicht')
                ->greeting('Hello ' . $notifiable->name . '!')
                ->line('Eine neue Bewertung wurde abgegeben.')
                ->line('Rating: ' . $this->review->rating . ' out of 5')
                ->line('Review: ' . $this->review->review_text)
                ->line('Product Title: ' . $product->title)
                ->action('Product URL', $productUrl)
                ->line('Thank you for using our application!')
                ->from('info@eestill.de', 'Saiful Alam')
                ->view('mail.reviewsubmittedemail', [
                    'rating' => $this->review->rating . ' out of 5',
                    'review' => $this->review->review_text,
                    'producttitle' => $product->title,
                    'productURL' => $productUrl,
                ]);
    }
    
    
}
