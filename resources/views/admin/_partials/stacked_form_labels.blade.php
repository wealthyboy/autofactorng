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

   /*
    * Use a real border on the control itself. Material Dashboard marks populated
    * fields with .is-filled and otherwise forces border-top-color: transparent;
    * these state-specific rules deliberately override that behavior.
    */
   .admin-stacked-labels .input-group.input-group-outline > .form-control,
   .admin-stacked-labels .input-group.input-group-outline > select.form-control,
   .admin-stacked-labels .input-group.input-group-outline > textarea.form-control {
      width: 100% !important;
      margin-left: 0 !important;
      border-width: 1px !important;
      border-style: solid !important;
      border-color: #a8b3c7 !important;
      border-top-color: #a8b3c7 !important;
      border-right-color: #a8b3c7 !important;
      border-bottom-color: #a8b3c7 !important;
      border-left-color: #a8b3c7 !important;
      border-radius: .5rem !important;
      background-color: #fff !important;
      background-image: none !important;
      box-shadow: none !important;
      outline: 0 !important;
   }

   /* Beat Material Dashboard's filled/validation selectors, which are more
      specific and set the top edge to transparent. */
   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-label + .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-valid > .form-label + .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-invalid > .form-label + .form-control {
      border-width: 1px !important;
      border-style: solid !important;
      border-color: #a8b3c7 !important;
      border-top-color: #a8b3c7 !important;
      border-right-color: #a8b3c7 !important;
      border-bottom-color: #a8b3c7 !important;
      border-left-color: #a8b3c7 !important;
      box-shadow: none !important;
   }

   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-label + .form-control,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-control,
   .admin-stacked-labels .input-group.input-group-outline > .form-control:focus,
   .admin-stacked-labels .input-group.input-group-outline > select.form-control:focus,
   .admin-stacked-labels .input-group.input-group-outline > textarea.form-control:focus {
      border-width: 2px !important;
      border-style: solid !important;
      border-color: #fb8c00 !important;
      border-top-color: #fb8c00 !important;
      border-right-color: #fb8c00 !important;
      border-bottom-color: #fb8c00 !important;
      border-left-color: #fb8c00 !important;
      box-shadow: 0 0 0 .2rem rgba(251, 140, 0, .12) !important;
      outline: 0 !important;
   }

   /* Keep the stacked label appearance even after Material Dashboard adds
      .is-filled/.is-focused classes. */
   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-label,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-label,
   .admin-stacked-labels .input-group.input-group-outline.is-valid > .form-label,
   .admin-stacked-labels .input-group.input-group-outline.is-invalid > .form-label {
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
   }

   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-label::before,
   .admin-stacked-labels .input-group.input-group-outline.is-filled > .form-label::after,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-label::before,
   .admin-stacked-labels .input-group.input-group-outline.is-focused > .form-label::after,
   .admin-stacked-labels .input-group.input-group-outline.is-valid > .form-label::before,
   .admin-stacked-labels .input-group.input-group-outline.is-valid > .form-label::after,
   .admin-stacked-labels .input-group.input-group-outline.is-invalid > .form-label::before,
   .admin-stacked-labels .input-group.input-group-outline.is-invalid > .form-label::after {
      display: none !important;
      content: none !important;
      border: 0 !important;
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
      border-top-color: #a8b3c7 !important;
      border-radius: .5rem !important;
      padding: .625rem .75rem !important;
      background-color: #fff !important;
      background-image: none !important;
      box-shadow: none !important;
   }

   .admin-stacked-labels .form-group.label-floating > .form-control:focus {
      border: 2px solid #fb8c00 !important;
      border-top-color: #fb8c00 !important;
      box-shadow: 0 0 0 .2rem rgba(251, 140, 0, .12) !important;
      outline: 0 !important;
   }
</style>
