<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
 Contact Course
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form method="POST" role="form" action="{{ $course->path() }}/contact">
            {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Contact: {{$course->title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-left">
            <div class="form-group">
               <label for="message-text" class="col-form-label">Message:</label>
               <textarea class="form-control" name="message-text" id="message-text"></textarea>
            </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Send Email</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>
