@extends('admin.layouts.app')

@section('content')
<div class="row">

    <div class="d-lg-flex mb-3">
        <div>
            <h5 class="mb-0">All Products</h5>
        </div>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
                <a href="{{ route('products.create') }}"" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Product</a>
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-products').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                   Delete
                </a>
                
                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            </div>
        </div>
    </div>
    <div class="card mb-3">

    <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
        <i class="material-symbols-outlined">filter_alt</i>
    </div>
    <h6 class="mb-0">FIlter</h6>
    </div>

     <div class="card-body pt-0">
        <div class="row">
            <div class="col-sm-4 col-12">
                <label class="form-label">Category</label>
                
                <select class="form-control" name="choices-gender" id="choices-gender">
                    <option value=""> Category</option>
                    <option value="3">Spare Parts</option>
                    <option value="5">Servicing Parts</option>
                    <option value="6">Accessories</option>
                    <option value="7">Car Care/Tools &amp; Multimedia</option>
                    <option value="8">Grille Guards</option>
                    <option value="9">Tyres</option>
                    <option value="10">Wheels</option>
                    <option value="11">Lubricants/Fluids</option>
                    <option value="12">Batteries</option>
                        
                        
                </select>
            </div>
            <div class="col-sm-4 col-12">
                <div class="input-group input-group-static">
                    <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Product Name">
                </div>
            </div>

            <div class="col-sm-4 col-12">
                <div class="input-group input-group-static">
                    <label>Part Number</label>
                    <input type="text" class="form-control" placeholder="Part Number">
                </div>
            </div>

           
        </div>
        <div class="row">
            <div class="">
                <div class="row">
                    <div class="col-sm-3 col-5">
                    <label class="form-label mt-4 ms-0">Make </label>
                    <select class="form-control" name="choices-month" id="choices-month"></select>
                    </div>
                    <div class="col-sm-3 col-3">
                    <label class="form-label mt-4 ms-0">Model </label>
                    <select class="form-control" name="choices-day" id="choices-day"></select>
                    </div>
                    <div class="col-sm-3 col-4">
                    <label class="form-label mt-4 ms-0">Year</label>
                    <select class="form-control" name="choices-year" id="choices-year"></select>
                    </div>
                    <div class="col-sm-3 col-4">
                      <div class="input-group input-group-static">
                          <label class="mt-4">Engine</label>
                          <input type="email" class="form-control" placeholder="Engine">
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-3">
            <div class="col-3">
                <div class="input-group input-group-static">
                    <label>Rim</label>
                    <input type="email" class="form-control" placeholder="rim">
                </div>
            </div>

            <div class="col-3">
                <div class="input-group input-group-static">
                    <label>Height</label>
                    <input type="email" class="form-control" placeholder="Height">
                </div>
            </div>

            <div class="col-3">
                <div class="input-group input-group-static">
                    <label>Width</label>
                    <input type="email" class="form-control" placeholder="Width">
                </div>
            </div>
            <div class="col-3">
                <div class="input-group input-group-static">
                    <label>Amphere</label>
                    <input type="email" class="form-control" placeholder="Amphere">
                </div>
            </div>
        </div>
        
        <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Search</button>
    </div>
</div>


    


    
        
<div class="card">
    

  <div class="table-responsive mt-5">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text">
                <div class="form-check p-0">
                    <input class="form-check-input" type="checkbox" id="customCheck5">
                </div>
          </th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Product</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Category</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Quantity</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Status</th>
          <th class="text-secondary opacity-7"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>
                <div class="form-check  p-3 pb-0">
                    <input class="form-check-input" type="checkbox" id="customCheck5">
                </div>
            </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-xs">Denso Horn</h6>
                <p class="text-xs text-secondary mb-0">3400 orders</p>
              </div>
            </div>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0">Spare Parts</p>
          </td>
          <td class="align-middle text-center text-sm">
             <span class="badge badge-sm badge-success">1</span>

          </td>
          <td class="align-middle text-center">
            <span class="badge badge-sm badge-success">Online</span>
          </td>
          <td class="align-middle">
            <a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
              Edit
            </a>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
</div>
@endsection
@section('inline-scripts')

if (document.getElementById('choices-gender')) {
      var gender = document.getElementById('choices-gender');
      const example = new Choices(gender);
    }

    if (document.getElementById('choices-language')) {
      var language = document.getElementById('choices-language');
      const example = new Choices(language);
    }

    if (document.getElementById('choices-skills')) {
      var skills = document.getElementById('choices-skills');
      const example = new Choices(skills, {
        delimiter: ',',
        editItems: true,
        maxItemCount: 5,
        removeItemButton: true,
        addItems: true
      });
    }

    if (document.getElementById('choices-year')) {
      var year = document.getElementById('choices-year');
      setTimeout(function() {
        const example = new Choices(year);
      }, 1);

      for (y = 1900; y <= 2020; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;

        if (y == 2020) {
          optn.selected = true;
        }

        year.options.add(optn);
      }
    }

    if (document.getElementById('choices-day')) {
      var day = document.getElementById('choices-day');
      setTimeout(function() {
        const example = new Choices(day);
      }, 1);


      for (y = 1; y <= 31; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;

        if (y == 1) {
          optn.selected = true;
        }

        day.options.add(optn);
      }

    }

    if (document.getElementById('choices-month')) {
      var month = document.getElementById('choices-month');
      setTimeout(function() {
        const example = new Choices(month);
      }, 1);

      var d = new Date();
      var monthArray = new Array();
      monthArray[0] = "January";
      monthArray[1] = "February";
      monthArray[2] = "March";
      monthArray[3] = "April";
      monthArray[4] = "May";
      monthArray[5] = "June";
      monthArray[6] = "July";
      monthArray[7] = "August";
      monthArray[8] = "September";
      monthArray[9] = "October";
      monthArray[10] = "November";
      monthArray[11] = "December";
      for (m = 0; m <= 11; m++) {
        var optn = document.createElement("OPTION");
        optn.text = monthArray[m];
        // server side month start from one
        optn.value = (m + 1);
        // if june selected
        if (m == 1) {
          optn.selected = true;
        }
        month.options.add(optn);
      }
    }

    function visible() {
      var elem = document.getElementById('profileVisibility');
      if (elem) {
        if (elem.innerHTML == "Switch to visible") {
          elem.innerHTML = "Switch to invisible"
        } else {
          elem.innerHTML = "Switch to visible"
        }
      }
    }

    var openFile = function(event) {
      var input = event.target;

      // Instantiate FileReader
      var reader = new FileReader();
      reader.onload = function() {
        imageFile = reader.result;

        document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile + '" class="rounded-circle w-100 shadow" />';
      };
      reader.readAsDataURL(input.files[0]);
    };


    if (document.getElementById('editor')) {
      var quill = new Quill('#editor', {
        theme: 'snow' // Specify theme in configuration
      });
    }

    if (document.getElementById('choices-multiple-remove-button')) {
      var element = document.getElementById('choices-multiple-remove-button');
      const example = new Choices(element, {
        removeItemButton: true
      });

      example.setChoices(
        [{
            value: 'One',
            label: 'Label One',
            disabled: true
          },
          {
            value: 'Two',
            label: 'Label Two',
            selected: true
          },
          {
            value: 'Three',
            label: 'Label Three'
          },
        ],
        'value',
        'label',
        false,
      );
    }

    if (document.querySelector('.datetimepicker')) {
      flatpickr('.datetimepicker', {
        allowInput: true
      }); // flatpickr
    }

    Dropzone.autoDiscover = false;
    var drop = document.getElementById('dropzone')
    var myDropzone = new Dropzone(drop, {
      url: "/file/post",
      addRemoveLinks: true

    });


@stop







