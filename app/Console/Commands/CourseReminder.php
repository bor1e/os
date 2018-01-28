<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Course;
use App\Jobs\CourseReminderJob;

class CourseReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:course {course?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder to students for specific course';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(! count($this->arguments()['course'])) {
            $courses = Course::where('date',today()->addDays(1))->get();
    #        dd($courses->pluck('title')->all());
            foreach ($courses as $course) {
                CourseReminderJob::dispatch($course);
            }
        } else {
            #dd($this->arguments()['course'][0]);
            $courses = Course::where($this->arguments()['course'][0]);
            foreach($this->arguments()['course'] as $slug) {
                CourseReminderJob::dispatch(Course::where('slug',$slug)->first());
            }
        }
    }
}
