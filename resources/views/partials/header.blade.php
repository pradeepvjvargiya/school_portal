<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4">Logo</span>
        </a>
        <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('/storage/' . auth()->user()->image) }}" alt="Student" width="50" height="50"
                    class="rounded-circle" />
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item"
                        href="{{ route('documents.index', ['student_id' => auth()->id()]) }}">Student
                        Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </header>
</div>
