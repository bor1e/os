<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', 'App\Course');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        #dd(request()->toArray());

        return [
          'title' => 'required|min:6|max:60',
          'date' => 'date_format:d.m.Y|after:today|required_if:status,published',
          'time' => 'date_format:H:i|required_if:status,published',
          'description' => 'required|min:50|max:160',
          'body'  => 'min:100|required_if:status,published',
          'language' => 'required',
          'slug' => 'required_if:status,published',
          'g2m_id' => 'nullable|active_url|required_if:status,published',
          'dedication' => 'nullable',
          'intervall' => 'required_if:status,published',
          'meetings' => 'required_if:status,published',
          'costs' => 'nullable',
          'channel_id' => 'required|exists:channels,id',
          'teacher_id' => 'bail|required_if:status,published|exists:teachers,id',
          'status' => 'required',
        ];
    }
}
