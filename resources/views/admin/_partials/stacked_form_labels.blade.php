<style>
   /*
    * Admin product/category forms use Material Dashboard's input-group-outline.
    * Its labels are absolutely positioned across the input border, which makes
    * populated edit forms look clipped. Keep labels permanently above fields.
    */
   .admin-stacked-labels .input-group.input-group-outline {
      display: flex !important;
      flex-direction: column !important;
      align-items: stretch !important;
      border: 0 !important;
      background: transparent !important;
      box-shadow: none !important;
   }

   /*
    * Material Dashboard builds part of the outline with pseudo-elements.
    * Once the label is stacked above the field those pieces leave a gap in
    * the top edge. Remove them and draw one complete outline on the control.
    */
   .admin-stacked-labels .input-group.input-group-outline::before,
   .admin-stacked-labels .input-group.input-group-outline::after {
      display: none !important;
      content: none !important;
      border: 0 !important;
   }

   .admin-stacked-labels .input-group.input-group-outline > .form-label {
      position: static !important;
      top: auto !important;
      left: auto !important;
      width: auto !important;
      height: auto !important;
      display: block !important;
      transform: none !important;
      line-height: 1.35 !important;
      margin: 0 0 .45rem .1rem !important;
      padding: 0 !important;
      color: #344767 !important;
      font-size: .875rem !important;
      font-weight: 600 !important;
      pointer-events: auto !important;
   }

   .admin-stacked-labels .input-group.input-group-outline > .form-label::before,
   .admin-stacked-labels .input-group.input-group-outline > .form-label::after {
      display: none !important;
      content: none !important;
   }

   .admin-stacked-labels .input-group.input-group-outline > .form-control,
   .admin-stacked-labels .input-group.input-group-outline > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline > textarea.form-control {
      width: 100% !important;
      margin-left: 0 !important;
      border: 0 !important;
      border-radius: .5rem !important;
      background-color: #fff !important;
      background-image: none !important;
      box-shadow: inset 0 0 0 1px #a8b3c7 !important;
      outline: 0 !important;
   }

   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > textarea.form-control {
      box-shadow: inset 0 0 0 1px #a8b3c7 !important;
   }

   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > textarea.form-control,
   .admin-stacked-labels .input-group.input-group-outline > .form-control:focus,
   .admin-stacked-labels .input-group.input-group-outline > select.form-control:focus,
   .admin-stacked-labels .input-group.input-group-outline > textarea.form-control:focus {
      box-shadow: inset 0 0 0 2px #fb8c00, 0 0 0 .2rem rgba(251, 140, 0, .12) !important;
   }

   .admin-stacked-labels .form-group.label-floating > .control-label {
      position: static !important;
      display: block !important;
      margin: 0 0 .45rem .1rem !important;
      color: #344767 !important;
      font-size: .875rem !important;
      font-weight: 600 !important;
      transform: none !important;
   }

   .admin-stacked-labels .form-group.label-floating > .form-control {
      border: 0 !important;
      border-radius: .5rem !important;
      padding: .625rem .75rem !important;
      background-color: #fff !important;
      background-image: none !important;
      box-shadow: inset 0 0 0 1px #a8b3c7 !important;
   }

   .admin-stacked-labels .form-group.label-floating > .form-control:focus {
      box-shadow: inset 0 0 0 2px #fb8c00, 0 0 0 .2rem rgba(251, 140, 0, .12) !important;
      outline: 0 !important;
   }
</style>
