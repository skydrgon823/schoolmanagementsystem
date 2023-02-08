@extends('layouts.master')
@section('page_title', 'Manage Exams')
@section('content')
<style>
    ul {
        list-style-type: none;
    }
    .forms_sitting_exam {
        margin: 1rem;
        padding: 0;
    }
    .one-sitting {
        border-top: 1px solid #00000042;
        border-bottom: 1px solid #00000042;
    }
    .one-sitting.odd {
        background: rgb(227 225 225 / 50%);
    }
    .active-state {
        display: none;
    }
    .card{
        margin-top:90px;overflow:hidden;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <h3>Form{{ $form->name }} - {{ $exam->name }} - Term{{ $exam->term }}</h3>
        </div>
        <div class="col-12">
            <hr>
            <p><h4>Subject Papers</h4></p>
        </div>
        <div class="col-12">
            <table class="table table-bordered" id="table_config">
                <?php $len = count($subjects); $i = 0;$ii=0;$iii=0; ?>
                @for ($i = 0; $i < $len; $i++)
                    @if ($subjects[$i]->status_x>0 || $subjects[$i]->status_y>0 || $subjects[$i]->status_z >0)
                        <?php ++$iii; ?>
                    @endif
                @endfor
                <thead>
                    <tr>
                        <th class="d-none">ID</th>
                        <th>#</th>
                        <th>Name</th>
                        <th>
                            <div class="row align-items-center justify-content-between">
                                <span>Papers</span>
                                <div>
                                    <button class="btn btn-secondary rounded-1" id="activeExam">
                                        <span id="txt-active-all">
                                            @if ($iii > 0)
                                                Disable all
                                            @else
                                                Enable all
                                            @endif
                                        </span>
                                    </button>
                                </div>
                            </div>

                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $len; $i++)
                        @if ($subjects[$i]->out_x>0 || $subjects[$i]->out_y>0 || $subjects[$i]->out_z >0)
                            <tr>
                            <td class="d-none" id="id{{ $ii }}">{{ $subjects[$i]->id }}</td>
                            <td>{{ ++$ii }}</td>
                            <td>{{ $subjects[$i]->title }}</td>
                            <td>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Paper Name</th>
                                            <th>Ratio</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($subjects[$i]->out_x>0)
                                            <tr>
                                                <td>Paper 1</td>
                                                <td class="out_x_val{{ $subjects[$i]->id }}">{{ $subjects[$i]->out_x }}</td>
                                                <td>
                                                    @if ($subjects[$i]->status_x>0)
                                                        <span class="bg-success p-2 out_x_active{{ $subjects[$i]->id }}" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_x_disable{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Disabled</span>
                                                    @else
                                                        <span class="bg-success p-2 out_x_active{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_x_disable{{ $subjects[$i]->id }}" style="border-radius: 5px;">Disabled</span>
                                                    @endif
                                                    <input type="checkbox" name="out_x_chk{{ $subjects[$i]->id }}" class="active-state out_x_chk{{ $subjects[$i]->id }}"
                                                    @if ($subjects[$i]->status_x>0)
                                                        checked
                                                    @endif
                                                    style="width: 20px;height:20px;">
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($subjects[$i]->out_y>0)
                                            <tr>
                                                <td>Paper 2</td>
                                                <td class="out_y_val{{ $subjects[$i]->id }}">{{ $subjects[$i]->out_y }}</td>
                                                <td>
                                                    @if ($subjects[$i]->status_y>0)
                                                        <span class="bg-success p-2 out_y_active{{ $subjects[$i]->id }}" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_y_disable{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Disabled</span>
                                                    @else
                                                        <span class="bg-success p-2 out_y_active{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_y_disable{{ $subjects[$i]->id }}" style="border-radius: 5px;">Disabled</span>
                                                    @endif
                                                    <input type="checkbox" name="out_y_chk{{ $subjects[$i]->id }}" class="active-state out_y_chk{{ $subjects[$i]->id }}"
                                                    @if ($subjects[$i]->status_y>0)
                                                        checked
                                                    @endif
                                                    style="width: 20px;height:20px;">
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($subjects[$i]->out_z>0)
                                            <tr>
                                                <td>Paper 3</td>
                                                <td class="out_z{{ $subjects[$i]->id }}">{{ $subjects[$i]->out_z }}</td>
                                                <td>
                                                    @if ($subjects[$i]->status_z>0)
                                                        <span class="bg-success p-2 out_z_active{{ $subjects[$i]->id }}" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_z_disable{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Disabled</span>
                                                    @else
                                                        <span class="bg-success p-2 out_z_active{{ $subjects[$i]->id }} active-state" style="border-radius: 5px;">Active</span>
                                                        <span class="bg-warning p-2 out_z_disable{{ $subjects[$i]->id }}" style="border-radius: 5px;">Disabled</span>
                                                    @endif
                                                    <input type="checkbox" name="out_z_chk{{ $subjects[$i]->id }}" class="active-state out_z_chk{{ $subjects[$i]->id }}"
                                                    @if ($subjects[$i]->status_z>0)
                                                        checked
                                                    @endif
                                                    style="width: 20px;height:20px;">
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </td>
                            <td class="text-right">
                                <div class="d-flex align-items-center justify-content-start">
                                    <button class="btn btn-secondary" onclick="editPaperRatio('{{ $subjects[$i]->id }}', this);">
                                        Edit/Add Paper
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif

                    @endfor

                </tbody>
            </table>
        </div>
        <div class="col-12 text-left pt-2">
            <a href="/exams" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@include('partials.js.exam_js')
@endsection
