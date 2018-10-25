@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @is('Desenvolvedor')
            <div class="col-3">
                <div class="small-card bg-gray">
                    <div class="inner">
                        <h3>{{ $countUser }}</h3>
                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    @if (hasPermission(['user.index']))
                        <a href="{{ route('user.index') }}" class="small-card-footer">Ver mais
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endis

            <div class="col-3">
                <div class="small-card bg-yellow">
                    <div class="inner">
                        <h3>{{ $countStudents }}</h3>
                        <p>Estudantes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    @if (hasPermission(['student.index']))
                        <a href="{{ route('student.index') }}" class="small-card-footer">Ver mais
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-3">
                <div class="small-card bg-blue-strong">
                    <div class="inner">
                        <h3>{{ $countCourse }}</h3>
                        <p>Cursos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>

                    @if (hasPermission(['user.index']))
                        <a href="{{route('course.index')}}" class="small-card-footer">Ver mais
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-3">
                <div class="small-card bg-light-blue">
                    <div class="inner">
                        <h3>{{ $countGroup }}</h3>
                        <p>Grupos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>

                    @if (hasPermission(['user.index']))
                        <a href="{{route('group.index')}}" class="small-card-footer">Ver mais
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
