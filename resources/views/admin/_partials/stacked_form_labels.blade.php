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
      border: 1px solid #a8b3c7 !important;
      border-radius: .5rem !important;
      border-top-color: #a8b3c7 !important;
      box-shadow: none !important;
   }

   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > textarea.form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > textarea.form-control {
      border-color: #344767 !important;
      border-top-color: #344767 !important;
      box-shadow: none !important;
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
      border: 1px solid #a8b3c7 !important;
      border-radius: .5rem !important;
      padding: .625rem .75rem !important;
   }
</style>
