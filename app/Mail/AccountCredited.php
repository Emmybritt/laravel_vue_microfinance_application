<?php

namespace App\Mail;

use App\Model\Transactions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCredited extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The transaction instance
     * 
     * @var \App\Models\Transactions
     */

     public $transactions;
    //  protected $transactions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transactions $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('beritogwu@gmail.com', 'Example')
                    ->view('emails.transaction');
                    // Sending Plain text email
                    // ->text('emails.transaction')



                    // Sending protected functions data
                    // return $this->from('beritogwu@gmail.com', 'Example')
                    // ->view('emails.transaction')->with([
                    //     'transaction' => $this->transactions,
                    // ]);

                    // To Add An Attachment we use this
                    // return ->view('emails.transaction')->attach('/path/to/file');

                    // to add display name and/or mime type
                    // return ->view('emails.transaction')->attach('/path/to/file', [
                    //     'as' => 'name.pdf',
                    //     'mime' => 'application/pdf'
                    // ]);      

    }
}
