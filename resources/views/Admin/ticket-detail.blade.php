<div class="card rounded-0">
    <div class="card-body">
        <div class="row">
            <h5 class="card-title d-flex  justify-content-between">
                <span>Detail</span>
                <span>Ticket no #{{ $ticket->id }}</span>
            </h5>

            <div class="mt-3">
                <p class="mb-1 fw-bold">Title :</p>
                <p>{{ $ticket->title }}</p>

                <p class="mb-1 fw-bold">Type :</p>
                <p>{{ $ticket->issue_type->type }}</p>

                <p class="mb-1 fw-bold">Assigned developers :</p>
                <ul>
                    @foreach($ticket->issue_assign_developer as $ad )
                        <li>{{ $ad->developer->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 my-3">
                <form action="{{ route('assign.developer') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <select class="form-select" name="developer[]" multiple aria-label="multiple select example">
                        <option selected>Assign developers</option>
                        @foreach($developers as $developer)
                            <option value="{{ $developer->id }}"  {{ old("developer") == $developer->id ? "selected" : "" }}>{{ $developer->name }}</option>
                        @endforeach
                    </select>
                    <div class="text-end">
                        <button class="btn btn-info mt-3">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
