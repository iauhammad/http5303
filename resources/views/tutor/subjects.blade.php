@extends('shared.tutor-layout')
@section('customMetas')
<meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection
@section('title', 'Profile')

@section('body')
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">List of Subjects</h4>
                <p class="category">Here is a list of subjects that you can add to your teaching list</p>
            </div>
            <div class="row">
                <div class="col-md-5" id="availableSubs">
                    <h5 class="select-box-title">Available Subjects</h5>
                    <div class="list-wrapper">
                        <select class="list-group">
                            @foreach($lstAvailableSubjects as $objSubject)
                                <option value="{{ $objSubject->id }}">{{ $objSubject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 text-center manage-buttons">
                    <div>
                        <button id="addSub" type="button" class="btn btn-success"
                                 title="Add subject to your list"><strong>>></strong></button>
                    </div>
                    <div>
                        <button id="removeSub" type="button" class="btn btn-danger"
                                title="Remove subject from your list"><strong><<</strong></button>
                    </div>
                </div>
                <div class="col-md-5" id="selectedSubs">
                    <h5 class="select-box-title">Subjects you Teach</h5>
                    <div class="list-wrapper">
                        <select class="list-group">
                            @foreach($lstSelectedSubjects as $objSubject)
                                <option value="{{ $objSubject->id }}">{{ $objSubject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Form to let user add custom subject names -->
                    <div class="form-group label-floating">
                        <label class="control-label">Add a new subject</label>
                        <input type="text" class="form-control" id="txtNewSubject" />
                        <button type="button" id="btnNewSubject"
                                class="btn btn-primary pull-right"
                                data-background-color="blue">Add Subject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/subjects.js') }}" type="text/javascript"></script>
@endsection
