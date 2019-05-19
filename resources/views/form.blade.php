<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" data-toggle="validator">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                            placeholder="Enter name">
                        <small id="nameHelp" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp"
                            placeholder="Enter phone">
                        <small id="phoneHelp" class="form-text text-danger"></small>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Religion</label>
                        </div>
                        <select class="custom-select" id="religion" name="religion">
                            <option selected>Choose...</option>
                            <option value="Islam">Islam</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Christian">Christian</option>
                        </select>
                    </div>
                    <small id="religionHelp" class="form-text text-danger"></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="insert-button"></button>
                <button type="button" class="btn btn-primary" id="update-button"></button>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large
    modal</button> --}}

<!-- Modal -->
<div class="modal fade" id="single-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Contact Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">Name: <span id="fullname"></span></li>
                    <li class="list-group-item">Email: <span id="contactemail"></span></li>
                    <li class="list-group-item">Phone: <span id="contactphone"></span></li>
                    <li class="list-group-item">Religion: <span id="contactreligion"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>