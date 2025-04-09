@extends('layout.navbar_teacher')
@section('title', 'Manage Scores')
@section('mainContent')
<div class="content">
    <div class="row ">
        <div class="col-lg-12 col-md-12">
        <div class="row g-2 mt-2">
            <div class="date_name">
                <h3>Greatings, {{ $teacher->tea_fname }}!</h3>
                <p id="currentDate"></p>
            </div>
            <div class="info-coures rounded mt-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center gap-4">
                        <a href="{{ route('teacher.course') }}" class="btn btn-primary"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        <h3>Manage Score</h3>
                    </div>
                </div>
                <hr>
                            <!-- Course Info Card -->
            <div class="card shadow-sm mt-4 mb-4">
                <div class="card-body">
                    <h4 class="card-title">
                        @if($course->teacher)
                            {{$course->sub_name}}
                        @else
                            No subject available
                        @endif
                    </h4>
                    <p class="text-muted">Teacher: {{$teacher->tea_fname}}</p>
                    
                    <!-- Add Score Form -->
                    <form action="{{route('teacher.score.create')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$course->cou_id}}" name="cou_id">
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label for="month">Select Month</label>
                                <select id="month" name="sco_month" class="form-select">
                                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 
                                            'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                        <option value="{{$month}}">{{$month}}</option>
                                    @endforeach
                                </select>  
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus-circle"></i> Add Scores
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Score Listings -->
            <div class="accordion" id="scoreAccordion">
                @if(!isset($selectallpoint))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No scores available yet.
                    </div>
                @else
                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 
                             'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        @if($selectallpoint->where('sco_month', $month)->count() > 0)
                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" 
                                            data-bs-toggle="collapse" data-bs-target="#month{{$month}}">
                                        {{$month}} Scores
                                    </button>
                                </h2>
                                <div id="month{{$month}}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @foreach($selectallpoint->where('sco_month', $month)->where('sco_cou_id', $course->cou_id) as $score)
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6>{{$score->stu_fname}} ({{$score->stu_id}})</h6>
                                                            <small class="text-muted">Class: {{$score->gra_class}}{{$score->gra_group}}</small>
                                                        </div>
                                                        <h4><span class="badge bg-success">{{$score->sco_point}}</span></h4>
                                                    </div>
                                                    
                                                    <form action="{{route('teacher.score.addscore')}}" 
                                                          method="post" 
                                                          class="mt-2" 
                                                          onsubmit="saveAccordionState(event)">
                                                        @csrf
                                                        <input type="hidden" name="sco_id" value="{{$score->sco_id}}">
                                                        <input type="hidden" name="stu_id" value="{{$score->stu_id}}">
                                                        <input type="hidden" name="cou_id" value="{{$score->cou_id}}">
                                                        <input type="hidden" name="current_month" value="{{$month}}">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" 
                                                                   value="{{$score->sco_point}}" 
                                                                   name="sco_point" required>
                                                            <button class="btn btn-warning">
                                                                <i class="fas fa-edit"></i> Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            </div>
        </div>

        </div>
    </div>
</div>

<style>
.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0c63e4;
}

.badge {
    font-size: 1rem;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,.05);
}

.accordion-item {
    border-radius: 8px;
    overflow: hidden;
}
</style>
@endsection

@section('scripts')
<script>
// Save accordion state before form submission
function saveAccordionState(event) {
    const month = event.target.querySelector('[name="current_month"]').value;
    localStorage.setItem('activeMonth', month); // Using localStorage instead of sessionStorage
}

// When page loads, restore accordion state
document.addEventListener('DOMContentLoaded', function() {
    const activeMonth = localStorage.getItem('activeMonth');
    if (activeMonth) {
        setTimeout(() => {
            const accordionElement = document.querySelector(`#month${activeMonth}`);
            if (accordionElement) {
                // Force open the accordion
                const bsCollapse = new bootstrap.Collapse(accordionElement, {
                    show: true,
                    toggle: true
                });
            }
        }, 100); // Small delay to ensure DOM is ready
    }
});

// Save state when accordion is manually toggled
document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', function() {
        const month = this.textContent.trim().split(' ')[0];
        if (this.classList.contains('collapsed')) {
            localStorage.removeItem('activeMonth');
        } else {
            localStorage.setItem('activeMonth', month);
        }
    });
});
</script>
@endsection

