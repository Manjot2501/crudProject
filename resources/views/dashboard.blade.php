<x-header />
<style>
    .mj-empty_container {
        width: 350px;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    li.list-group-item.show .list-group {
        display: block !important;
    }

    li.list-group-item.show>div {
        background: #e000ff;
        color: #fff;
    }
</style>

<body>
    <div class="container">
        <header class="text-center py-3 shadow-sm">
            <h1>Laravel Assignment</h1>
            <ul class="nav justify-content-center|justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('subjects') }}">Subject</a>
                </li>
            </ul>
        </header>

        <div class="row">
            <div class="col-md-12">
                @if (!empty(count($subjectList)))
                <div class="mt-4">
                    <ul class="list-group">
                        @foreach ($subjectList as $item)
                        @php
                        $chapterCheck = is_array(json_decode($item->chapter)) ? 1 : 0;
                        $chapterList = !empty($chapterCheck) ? json_decode($item->chapter, true) : '';
                        @endphp
                        <li class="list-group-item mj-subject_container p-0">
                            <div class="d-flex justify-content-between py-2 px-3">
                                <h5 class="m-0">{{ $item->title }}</h5>
                                @if ($chapterCheck)
                                <span>
                                    <i class='bx bx-sm bx-plus-circle showMore'></i>
                                    <i class='bx bx-sm bx-minus-circle showRemove d-none'></i>
                                </span>
                                @endif
                            </div>
                            @if ($chapterCheck)
                            <ul class="list-group d-none">
                                @foreach ($chapterList as $chapter)
                                <li class="list-group-item border-start-0 border-end-0">
                                    {{ $chapter['name'] }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            @endforeach
                    </ul>
                </div>
                @else
                <p class="text-danger fs-3 text-center">
                    No Data Found
                </p>
                @endif
            </div>
        </div>
    </div>

    <script>
        $('.showMore').click(function() {
            $('.mj-subject_container').removeClass('show')
            $('.showMore').removeClass('d-none')
            $('.showRemove').addClass('d-none')

            $(this).parent().parent().parent().addClass('show')
            $(this).addClass('d-none')
            $(this).next().removeClass('d-none')
        })
        $('.showRemove').click(function() {
            $(this).parent().parent().parent().removeClass('show')
            $(this).addClass('d-none')
            $(this).prev().removeClass('d-none')
        })
    </script>

    <x-footer />
