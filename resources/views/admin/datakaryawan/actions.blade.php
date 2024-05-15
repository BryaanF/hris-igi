<div class="d-flex">
    {{-- <a href="{{ route('datakaryawan.show', $satudatakaryawan->id_data_karyawan) }}"
        class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a> --}}
    <button class="btn btn-outline-dark btn-sm me-2" data-bs-toggle="modal" data-bs-target="#showDataKaryawan"><i
            class="bi-person-lines-fill"></i></button>
    <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
    <div>
        <form action="{{ route('datakaryawan.destroy', $satudatakaryawan->id_data_karyawan) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn-delete btn btn-outline-dark btn-sm
    me-2"><i
                    class="bi-trash"></i></button>
        </form>
    </div>
</div>
