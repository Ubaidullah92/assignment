@extends('master')

@section('container')
<div id="student">
           
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-header">
				<thead>
					<tr>
						<th style="width: 16%;">
							Title
						</th>
						<th>
							Details
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Id    :
                        </td>
                        <td>
							{{$student->id}}
						</td>
                    </tr>
                    <tr>
						<td>
							Name    :
                        </td>
                        <td>
                            {{$student->name}}
						</td>
					</tr>
                    <tr>
						<td>
							Class    :
                        </td>
                        <td>
                            {{$student->class->name}}
						</td>
					</tr>
                    <tr>
						<td>
						    Year    :
                        </td>
                        <td>
                            {{$student->class->year}}
						</td>
					</tr>
                    <tr>
						<td>
							Date of Birth    :
                        </td>
                        <td>
                        {{$student->dob}}
						</td>
					</tr>
                    <tr>
						<td>
							City    :
                        </td>
                        <td>
                            {{$student->city}}
						</td>
                    </tr>
                @foreach($student->parents as $parent)
                @if($parent->type == 'M')
                    <tr>
						<td>
							Father's Name    :
                        </td>
                        <td >
                            {{$parent->name}}
						</td>
					</tr>
                    <tr>
						<td>
							Date of birth    :
                        </td>
                        <td>
                            {{$parent->dob}}
						</td>
                    </tr>
                @endif
                @if($parent->type == 'F')
                    <tr>
						<td>
							Mother's Name    :
                        </td>
                        <td >
                            {{$parent->name}}
						</td>
					</tr>
                    <tr>
						<td>
							Date of birth    :
                        </td>
                        <td>
                            {{$parent->dob}}
						</td>
                    </tr>
                @endif
                @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
