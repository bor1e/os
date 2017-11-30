<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Mail\ContactMail;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|min:5',
          'email' => 'required|email',
          'subject' => 'required',
          'message' => 'required|min:15',
          'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function sendMail()
    {
      \Mail::to('online.shiur@gmail.com')->send(new ContactMail($this));
    }
}
