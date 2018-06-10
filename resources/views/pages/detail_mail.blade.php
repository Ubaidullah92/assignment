<h2> Students Detials</h2>
    <div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-header">
				<thead>
					<tr>
						<th style="width: 16%;">
							Name
						</th>
						<th>
							Age
                        </th>
                        <th>
							parents
                        </th>
                        <th>
							Class
						</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($students as $student)
					<tr>
						<td>
							{{$student->name}}
                        </td>
                        <td>
							{{$student->age}}
                        </td>
                        <td>
							{{$student->parents[0]->name}}, {{$student->parents[1]->name}}
                        </td>
                        <td>
                        {{$student->class->name}}
						</td>
                    </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>