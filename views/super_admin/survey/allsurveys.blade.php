@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <table class="datatable table table-hover nowrap w-100 table_for_school" >
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Schools</th>
                    <th>Number Of Reply</th>
                    <th>Date Of Creation</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($surveys as $key => $survey)
                    <tr >
                        <td>{{$survey->name}}</td>
                        <td>
                            @foreach(App\SurveyOfTheSchool::where('survey_id' , $survey->id)->get() as $SurveyOfTheSchool)
                                <p>
                                    {{$SurveyOfTheSchool->GetSchoolInfo->name}}
                                </p>
                            @endforeach
                        </td>
                        <td>
                            {{App\ResultOfTheSurvey::where('survey_id',$survey->id)->groupBy('user_id')->selectRaw('user_id')->get()->count()}}
                        </td>
                        <td>
                            {{$survey->created_at}}
                        </td>
                        <td>
                            <button access="{{ Crypt::encrypt($survey->id) }}" data="Survey" class="btn btn-outline-danger SADelete ml-1">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection














