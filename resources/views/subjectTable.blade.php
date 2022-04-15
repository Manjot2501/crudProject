<div>
    <div class="mj-table_head d-flex justify-content-between p-2 bg-light border border-bottom-0">
        <h3 class="m-0">Subject List</h3>
        <button class="btn btn-sm btn-primary d-flex" type="button" data-bs-toggle="modal"
            data-bs-target="#addSubjectModel">
            <i class='bx bx-sm bx-plus-circle me-2'></i> Add More
        </button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Chapter</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($subjectList as $item)
                @php
                    $chapterCheck = is_array(json_decode($item->chapter)) ? 1 : 0;
                    $chapterList = !empty($chapterCheck) ? json_decode($item->chapter, true) : '';
                @endphp
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>
                        @foreach ($chapterList as $chapter)
                            {{ $chapter['name'] . ', ' }}
                        @endforeach
                    </td>
                    <td data-id={{ $item->id }} style="max-width:200px;">
                        <button class="me-3 mj-fetchSubject btn btn-primary btn-sm" title="edit">
                            <i class='bx bx-sm bx-edit-alt'></i>
                        </button>
                        <button title="delete" class="btn btn-danger btn-sm mj-deleteSubject">
                            <i class='bx bx-sm bxs-trash'></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    var editCount = 0;
    $('.mj-deleteSubject').on('click', function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('deleteSubject') }}";
        __ajax(url, data, function(output) {
            if (output.code == 100) {
                $('.mj-alert').addClass('alert-danger');
            } else {
                $('.mj-subjectView').html(output.html)
                $('.mj-alert').addClass('alert-primary');
            }
            $('.mj-alert').text(output.msg);
            $('.mj-alert').removeClass('d-none');
        })
    })
    $('.mj-fetchSubject').on('click', function() {
        let data = {
            id: $(this).parent().attr('data-id'),
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('subjectsDetails') }}";
        __ajax(url, data, function(output) {
            let chapter = JSON.parse(output.chapter)
            $('#editSubjectModel').modal('show')
            $('.editTitle').val(output.title)
            $('.editID').val(output.id)
            $.each(chapter, function(key, val) {
                editCount++
                if (key == 0) {
                    $('.editChapter').val(val.name)
                } else {
                    $('.mj-editAddInputBox').after(
                        ` <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control chapter" name="chapter[]" value="` + val
                        .name + `" required>
                                </div>
                            </div>`
                    );
                }
            });
            if (editCount > 1) {
                $('.mj-editRemoveInput').css('cursor', 'pointer')
            }
        })

    })

</script>
