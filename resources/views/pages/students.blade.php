@extends('master')

@section('container')
<div>
        <a href="{{ route('logout') }}"  class="btn btn-danger">logout</a>
    </div>  
<div id="student">
    <div class="panel panel-default" >  
        <div class="panel-heading filter-panel-heading">Advance Search
        </div>
        <div class="panel-body" style="font-size: 12px;padding:0">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form class="form-inline">
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="form-group">
                                <label>show all the students who are older than </label>
                                <input type="number" class="form-control"
                                        name="age"
                                        placeholder="18" v-model="filter.age" required>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-info" @click=fitlerOne()>
                                        Filter 1
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form class="form-inline">
                    <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="form-group">
                                <label>show all the students in class </label>
                                <select class="form-control"  v-model="filter.class">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>in </label>
                                <input type="number" class="form-control"
                                        name="year"
                                        placeholder="2010" v-model="filter.year">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-info"  @click=fitlerTwo()>
                                        Filter 2
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form class="form-inline" >
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="form-group">
                                <label>show the class and the parents for given student id </label>
                                <input type="number" class="form-control"
                                        name="studentId"
                                        placeholder="1" v-model="filter.student_id">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <a :href="'student/'+filter.student_id" class="btn btn-info">
                                        Filter 3
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form class="form-inline">
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="form-group">
                                <label>show students who are older than</label>
                                <input type="number" class="form-control"
                                        name="student_age"
                                        placeholder="1" v-model="filter.stuent_age">
                            </div>
                            <div class="form-group">
                                <label>and who have parents older than</label>
                                <input type="number" class="form-control"
                                        name="parent_age"
                                        placeholder="1" v-model="filter.parent_age">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-info" @click=fitlerThree() >
                                        Filter 4
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@if($role == 'admin')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('student.create') }}" class="btn btn-info">Add new studend</a>
        </div>
    </div>
@endif
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-header">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Name
						</th>
						<th>
							Class
						</th>
						<th>
							Date of birth
						</th>
                        <th>
							City
						</th>
                        <th>
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(student,index) in students">
						<td>
							@{{index + 1}}
						</td>
						<td>
                        @{{student.name}}
						</td>
						<td>
                        @{{student.class.name}}
						</td>
						<td>
                        @{{student.dob}}
						</td>
                        <td>
                        @{{student.city}}
						</td>
                        <td>
                            <a :href="'student/'+student.id" type="button" class="btn btn-sm btn-success">
                                View
                            </a> 
                            @if($role == 'admin')
                            <button type="button" class="btn btn-danger btn-sm" @click="destroy(student.id)">
                                Delete
                            </button>
                            @endif
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
@push('script')
<script>

    var userMag = new Vue({
        el: '#student',
        data: {
            students:[],
            filter:{
                age: 18,
                class:'10',
                year:2010,
                student_id:1,
                stuent_age:16,
                parent_age:50
            }
        },
        mounted(){
            this.getAllStudent();
        },
        methods:{
            getAllStudent(query=''){
                axios.get('/student/all'+query).then(function(response){
                    this.students = response.data.students;
                }.bind(this))
            },
            fitlerOne(){
                let query ='?studentAge='+this.filter.age
                this.getAllStudent(query)
            },
            fitlerTwo(){
                let query ='?class='+this.filter.class +'&year='+this.filter.year
                this.getAllStudent(query)
            },
            fitlerThree(){
                let query ='?studentAge='+this.filter.stuent_age+'&parentAge='+this.filter.parent_age
                this.getAllStudent(query)
            },
            destroy(id){
                axios.delete('/student/'+id).then(function(response){
                    this.students = response.data.students;
                }.bind(this))
            }
        }
    })
</script>

@endpush