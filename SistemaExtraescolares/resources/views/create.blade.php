@extends('layouts.app') <!-- O usa la plantilla que tengas -->

@section('content')
<div class="container">
    <h1>Completar Datos de Alumno</h1>
    
    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" class="form-control" id="matricula" name="matricula" maxlength="8" required>
            @error('matricula')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="carrera" class="form-label">Carrera</label>
            <select class="form-control" id="carrera" name="carrera" required>
                <option value="">-- Seleccionar --</option>
                <option value="informatica">Ingeniería Informática</option>
                <option value="sistemas">Ingeniería en Sistemas</option>
                <option value="civil">Ingeniería Civil</option>
                <option value="ige">Ingeniería en Gestión Empresarial</option>
                <option value="contador">Contador Público</option>
            </select>
            @error('carrera')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-control" id="semestre" name="semestre" required>
                <option value="">-- Seleccionar --</option>
                @for($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('semestre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="periodo" class="form-label">Periodo</label>
            <input type="text" class="form-control" id="periodo" name="periodo" required>
            @error('periodo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
