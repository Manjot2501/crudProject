<x-header />

<div class="container">
    <header class="text-center py-3 shadow-sm">
        <h1>Subject List</h1>
        <ul class="nav justify-content-center|justify-content-end">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('subjects') }}">Subject</a>
            </li>
        </ul>
    </header>

    <main>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-5 ">
                    <div class="alert mj-alert d-none" role="alert"></div>
                    <div class="mj-subjectView">
                        {!! $html !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- Create Modal -->
<div class="modal fade" id="addSubjectModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Subject Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="createSubjectForm">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control Title" name="Title" required>
                        </div>
                    </div>
                    <div class="mb-3 row mj-addInputBox">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Chapters</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control chapter" name="chapter[]" required>
                        </div>
                    </div>

                    <div class="mj-action_Btn">
                        <div class="btn btn-success btn-sm">
                            <i class='bx bx-sm bx-plus-circle mj-addInput' title="Add input"></i>
                        </div>
                        <div class="btn btn-danger btn-sm">
                            <i class='bx bx-sm bx-minus-circle mj-removeInput' title="Remove input" style="cursor:not-allowed;"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitCreateForm">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- edit Modal -->
<div class="modal fade" id="editSubjectModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Subject Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="editSubjectForm">
                    <input type="hidden" class="editID" name="id">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control editTitle" name="editTitle" required>
                        </div>
                    </div>
                    <div class="mb-3 row mj-editAddInputBox">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Chapters</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control editChapter" name="editChapter[]" required>
                        </div>
                    </div>

                    <div class="mj-editAction_Btn">
                        <div class="btn btn-success btn-sm">
                            <i class='bx bx-sm bx-plus-circle mj-editAddInput' title="Add input"></i>
                        </div>
                        <div class="btn btn-danger btn-sm">
                            <i class='bx bx-sm bx-minus-circle mj-editRemoveInput' title="Remove input" style="cursor:not-allowed;"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitEditForm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var count = 1
        $('.mj-addInput').click(function() {
            count++
            if (count > 1) {
                $('.mj-removeInput').css('cursor', 'pointer')
            }
            $('.mj-addInputBox').after(
                ` <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control chapter" name="chapter[]" required>
                        </div>
                    </div>`
            );

        })
        $('.mj-removeInput').click(function() {
            count--
            if (count == 1) {
                $('.mj-removeInput').css('cursor', 'not-allowed')
            }
            $('.mj-action_Btn').prev().remove();
        })

        $('.submitCreateForm').click(function() {
            $('.mj-alert').addClass('d-none');
            let title
            let chapter = []
            let formdata = $('form.createSubjectForm').serializeArray()
            let i = 0
            for (let index = 0; index < formdata.length; index++) {
                if (formdata[index].value) {
                    if (formdata[index].name == 'Title') {
                        title = formdata[index].value;
                    } else {
                        chapter[i] = {
                            'name': formdata[index].value
                        };
                        i++
                    }
                }
            }
            let data = {
                title: title,
                chapter: chapter,
                _token: "{{ csrf_token() }}"
            }
            let url = "{{ route('addSubject') }}";
            $('#addSubjectModel').modal('hide');
            __ajax(url, data, function(output) {
                if (output.code == 100) {
                    $('.mj-alert').addClass('alert-danger');
                } else {
                    $('.mj-subjectView').html(output.html)
                    $('.mj-alert').addClass('alert-primary');
                }
                $('.mj-alert').text(output.msg);
                $('.mj-alert').removeClass('d-none');
            });

        })

        $('.mj-editAddInput').click(function() {
            editCount++
            if (editCount > 1) {
                $('.mj-editRemoveInput').css('cursor', 'pointer')
                $('.mj-editAction_Btn').before(
                    ` <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control chapter" name="chapter[]" required>
                            </div>
                        </div>`
                );
            }

        })
        $('.mj-editRemoveInput').click(function() {
            editCount--
            if (editCount < 1) {
                $('.mj-editRemoveInput').css('cursor', 'not-allowed')
            }else{
                $('.mj-editRemoveInput').css('cursor', 'pointer')
                $('.mj-editAction_Btn').prev().remove()
            }
        })


        $('.submitEditForm').click(function() {
            $('.mj-alert').addClass('d-none');
            let title,id
            let chapter = []
            let formdata = $('form.editSubjectForm').serializeArray()
            let i = 0
            for (let index = 0; index < formdata.length; index++) {
                if (formdata[index].value) {
                    if (formdata[index].name == 'editTitle') {
                        title = formdata[index].value;
                    }else if (formdata[index].name == 'id') {
                        id = formdata[index].value;
                    }else {
                        chapter[i] = {
                            'name': formdata[index].value
                        };
                        i++
                    }
                }
            }
            let data = {
                title: title,
                id: id,
                chapter: chapter,
                _token: "{{ csrf_token() }}"
            }
            let url = "{{ route('editSubject') }}";
            $('#editSubjectModel').modal('hide');
            __ajax(url, data, function(output) {
                if (output.code == 100) {
                    $('.mj-alert').addClass('alert-danger');
                } else {
                    $('.mj-subjectView').html(output.html)
                    $('.mj-alert').addClass('alert-primary');
                }
                $('.mj-alert').text(output.msg);
                $('.mj-alert').removeClass('d-none');
            });

        })
    });
</script>

<x-footer />
