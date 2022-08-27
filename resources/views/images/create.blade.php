@extends('layouts.app')

@section('content')
<style>
    #result {
        display: flex;
        gap: 10px;
        padding: 10px 0;
    }

    .thumbnail {
        height: 200px;
    }
</style>
<div class="container-fluid">
    <div class="card">
        <div class="card-header"> <a class="btn btn-success float-end" href="{{route('images')}}">Retour</a></div>
        <div class="card-body">
            <label for="files" class="form-header">Select multiple files</label>
            <input class="form-control" id="files" type="file" multiple="multiple"
                accept="image/jpeg, image/png, image/jpg">
            <input type="hidden" value="{{auth()->id()}}" id="auth">
            <button class="btn btn-success mt-2 mb-3" onclick="upload()">upload</button>
            <div id="progress">

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('files').value = "";
    const auth = document.getElementById('auth').value;
    const files = []; 
    document.querySelector("#files").addEventListener("change", (e) => {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            this.files = e.target.files;
            console.log(this.files);
        }
        else {
            alert("Your browser does not support File API");
        }
    });
 function postData(index,files){
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            let data = new FormData();
            data.append('image', files[index]);
            data.append('id', index);
            data.append('auth', auth);
            axios.post('{{route('image.create')}}', data, {
            headers: {
            'Content-Type': 'multipart/form-data'
            }}).then(async function (response) {
                resolve (response);
            });
                }, 500);
            })
        }

 async function upload() {
    const length = this.files.length;
    for (let index = 0; index < length; index++) {
       
        let response = await postData(index,this.files);
        one = (100 * 1) / length
        pourcent = ((100 * response.data.id) / length) + one;
        console.log(pourcent);
        progress = '<div class="progress">'
                  + ' <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: ' + pourcent + '%;" aria-valuenow="' + pourcent + '" aria-valuemin="0" aria-valuemax="100"></div>'
                  + '</div>';
        document.getElementById('progress').innerHTML = progress;
       if (pourcent === 100) {
        swal("Good job!", "You clicked the button!", "success").then(() => {
            location.href = '{{route('images')}}';
        });;
       }
        console.log(response.data);
        
       
    };
}
</script>
@endsection