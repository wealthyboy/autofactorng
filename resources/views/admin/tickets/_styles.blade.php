<style>
    .ticket-form-card {
        border: 1px solid #e9ecef;
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(52, 71, 103, .06);
    }
    .ticket-form-label {
        color: #344767;
        font-size: .8rem;
        font-weight: 600;
        margin-bottom: .45rem;
    }
    .ticket-control {
        background-color: #fff !important;
        border: 1px solid #d2d6da !important;
        border-radius: .65rem !important;
        color: #344767;
        min-height: 44px;
        padding: .65rem .8rem !important;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .ticket-control:focus {
        border-color: #344767 !important;
        box-shadow: 0 0 0 3px rgba(52, 71, 103, .12) !important;
        outline: 0;
    }
    textarea.ticket-control {
        line-height: 1.55;
        min-height: 150px;
        resize: vertical;
    }
    select.ticket-control { cursor: pointer; }
    .ticket-order-group .ticket-control { border-radius: .65rem 0 0 .65rem !important; }
    .ticket-order-group .btn { border-radius: 0 .65rem .65rem 0; min-height: 44px; }
    .ticket-preview {
        background: #f8f9fa;
        border: 1px solid #e9ecef !important;
        border-radius: .75rem !important;
    }
    .ticket-return-item {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: .7rem;
    }
    .ticket-return-item .ticket-control { min-height: 38px; padding: .4rem .6rem !important; }
    .ticket-return-total {
        background: #eef2ff;
        border: 1px solid #dfe5ff;
        border-radius: .7rem;
        color: #344767;
    }
    .ticket-dynamic-panel,
    .ticket-email-preview {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: .75rem;
    }
    .ticket-dynamic-panel { padding: 1rem; }
</style>
