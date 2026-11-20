<link rel="stylesheet" type="text/css" href="<?=plugin_http_path('assets/css/style.css')?>">
<style>
    *{
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .dashboard {
        display: flex;
        width: 100%;
    }

    /* Main content styling */
    .main-content {
        background-color: #f8f9fa;
        width: 80%;
        padding: 20px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #444;
    }

    .card p {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ff5722;
    }

    .form-control{
        border: none;
        border-bottom: 0.5px solid lightgreen;
    }

    legend{
        color: lightgreen;
        font-family: tahoma;
        font-weight: bolder;
    }

    .dashboard-card {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
        transition: 0.3s ease-in-out;
    }
    .dashboard-card .fa {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .dashboard-card h3, .dashboard-card table, {
        margin-top: 0;
    }

    .dashboard-card:hover {
        color: rgb(108, 117, 125) !important;
        background-color: yellow !important;
        font-size: 15px !important;
    }

    a{
        text-decoration: none;
    }

    .recent-activities {
        margin: 0;
    }

    .activityContainer {
        max-height: 53vh;
        overflow-y: auto;
    }

   .custom-popover {
        --bs-popover-max-width: 200px;
        --bs-popover-border-color: lightgreen !important;
        --bs-popover-header-bg:  lightgreen !important;
        --bs-popover-header-color: red;
        --bs-popover-body-padding-x: 1rem;
        --bs-popover-body-padding-y: .5rem;
    }

    a{
        color: var(--text-color);
    }

    .text-yellow { color: #ffc107; }
      .card-ash {
        background-color: var(--bs-body-bg);
        border-radius: 10px;
        border: 1px solid rgba(148,163,184,0.5);
        color: var(--bs-body-color) !important;
        transition: background-color 0.3s ease, color 0.3s ease,
                    border-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 10px 25px rgba(15,23,42,0.06);
      }
      [data-bs-theme="light"] .card-ash {
        background: linear-gradient(135deg, #ffffff, #f9fafb);
        border-color: rgba(148,163,184,0.35);
      }
      [data-bs-theme="dark"] .card-ash {
        background: linear-gradient(135deg, rgba(15,23,42,0.98), rgba(30,41,59,0.96));
        border-color: rgba(148,163,184,0.6);
        color: #f9fafb !important;
        box-shadow: 0 18px 40px rgba(15,23,42,0.95);
      }

      .card-ash .card-header {
        border-bottom: 1px solid rgba(148,163,184,0.6);
      }
      .sparkline { height: 30px; }
      .chart-header { font-weight: 600; }
      #imgcard{
        width: 20px;
        height: 20px;
        border-radius: 5px;
        object-fit: fill;
      }

      #metricsRow .metric-card {
        --metric-accent: #2563eb;
        --metric-tint: rgba(37, 99, 235, .1);
        position: relative;
        display: grid;
        grid-template-columns: auto minmax(0, 1fr);
        grid-template-rows: minmax(0, 1fr) 18px;
        align-content: start;
        align-items: start;
        gap: .6rem;
        height: 156px;
        min-height: 156px;
        padding: .75rem !important;
        overflow: hidden;
        border-left: 3px solid var(--metric-accent);
        border-radius: .9rem;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
      }
      #metricsRow > div:nth-child(4n + 2) .metric-card {
        --metric-accent: #0f9f8f;
        --metric-tint: rgba(15, 159, 143, .12);
      }
      #metricsRow > div:nth-child(4n + 3) .metric-card {
        --metric-accent: #7c3aed;
        --metric-tint: rgba(124, 58, 237, .12);
      }
      #metricsRow > div:nth-child(4n + 4) .metric-card {
        --metric-accent: #d97706;
        --metric-tint: rgba(217, 119, 6, .13);
      }
      #metricsRow .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .12);
      }
      [data-bs-theme="dark"] #metricsRow .metric-card:hover {
        box-shadow: 0 14px 30px rgba(0, 0, 0, .35);
      }
      #metricsRow .metric-card-icon {
        display: grid;
        width: 2.3rem;
        height: 2.3rem;
        place-items: center;
        border-radius: .8rem;
        color: var(--metric-accent);
        background: var(--metric-tint);
      }
      #metricsRow .metric-card-icon i {
        font-size: 1rem;
      }
      #metricsRow .metric-card-copy {
        min-width: 0;
      }
      #metricsRow .metric-card-label {
        display: block;
        margin: .05rem 0 .25rem;
        color: var(--bs-secondary-color);
        font-size: .73rem;
        font-weight: 700;
        letter-spacing: .045em;
        line-height: 1.25;
        text-transform: uppercase;
      }
      #metricsRow .metric-card-value {
        margin: 0;
        color: var(--bs-emphasis-color);
        font-size: clamp(1.15rem, 1.7vw, 1.55rem);
        font-weight: 750;
        letter-spacing: -.045em;
        line-height: 1.1;
        overflow-wrap: anywhere;
      }
      #metricsRow .metric-card-support {
        display: block;
        margin-top: .2rem;
        color: var(--bs-secondary-color);
        font-size: .72rem;
        line-height: 1.35;
        overflow-wrap: anywhere;
      }
      #metricsRow .sparkline {
        grid-column: 1 / -1;
        width: 100% !important;
        height: 18px !important;
        max-height: 18px;
        margin-top: 0;
      }
      [data-bs-theme="dark"] #metricsRow .metric-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, .98), rgba(30, 41, 59, .96));
      }

      .activity-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
      }
      .activity-heading {
        display: flex;
        align-items: center;
        gap: .8rem;
        min-width: 0;
      }
      .activity-heading-icon {
        display: grid;
        width: 2.75rem;
        height: 2.75rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .85rem;
        color: #1d4ed8;
        background: rgba(37, 99, 235, .1);
      }
      [data-bs-theme="dark"] .activity-heading-icon {
        color: #bfdbfe;
        background: rgba(37, 99, 235, .2);
      }
      .activity-heading h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 750;
        letter-spacing: -.02em;
      }
      .activity-heading p {
        margin: .2rem 0 0;
        color: var(--bs-secondary-color);
        font-size: .82rem;
      }
      .activity-record-count {
        display: inline-flex;
        align-items: center;
        margin-left: .35rem;
        border: 1px solid rgba(37, 99, 235, .18);
        border-radius: 999px;
        padding: .12rem .45rem;
        color: #1d4ed8;
        background: rgba(37, 99, 235, .07);
        font-size: .7rem;
        font-weight: 700;
        white-space: nowrap;
      }
      [data-bs-theme="dark"] .activity-record-count {
        border-color: rgba(96, 165, 250, .28);
        color: #bfdbfe;
        background: rgba(37, 99, 235, .2);
      }
      .activity-search {
        position: relative;
        width: min(100%, 300px);
        flex: 0 1 300px;
      }
      .activity-search i {
        position: absolute;
        top: 50%;
        left: .85rem;
        color: var(--bs-secondary-color);
        transform: translateY(-50%);
      }
      .activity-search input {
        min-height: 42px;
        padding-left: 2.35rem;
        border: 1px solid var(--bs-border-color);
        border-radius: .7rem;
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
      }
      .activity-table-wrap {
        overflow-x: auto;
      }
      .activity-table {
        min-width: 600px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 .4rem;
        vertical-align: middle;
      }
      .activity-table thead th {
        padding: .55rem .85rem;
        border: 0;
        color: var(--bs-secondary-color);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
      }
      .activity-table tbody td {
        padding: .85rem;
        border: 0;
        background: rgba(148, 163, 184, .08);
      }
      .activity-table tbody td:first-child {
        width: 235px;
        border-radius: .7rem 0 0 .7rem;
      }
      .activity-table tbody td:last-child {
        border-radius: 0 .7rem .7rem 0;
      }
      .activity-table tbody tr:hover td {
        background: rgba(37, 99, 235, .07);
      }
      .activity-date {
        color: #1d4ed8;
        font-size: .78rem;
        font-variant-numeric: tabular-nums;
      }
      .activity-date-badge {
        display: inline-flex;
        align-items: flex-start;
        gap: .45rem;
        max-width: 100%;
        border: 1px solid rgba(37, 99, 235, .15);
        border-radius: .65rem;
        padding: .42rem .55rem;
        background: rgba(37, 99, 235, .06);
        line-height: 1.35;
      }
      .activity-date-badge i {
        margin-top: .1rem;
        color: #2563eb;
      }
      [data-bs-theme="dark"] .activity-date {
        color: #bfdbfe;
      }
      [data-bs-theme="dark"] .activity-date-badge {
        border-color: rgba(96, 165, 250, .22);
        background: rgba(37, 99, 235, .14);
      }
      [data-bs-theme="dark"] .activity-date-badge i {
        color: #93c5fd;
      }
      .activity-description {
        color: var(--bs-emphasis-color);
        line-height: 1.5;
      }
      .activity-description::before {
        display: inline-block;
        width: .45rem;
        height: .45rem;
        margin: 0 .65rem .08rem 0;
        border-radius: 50%;
        background: #10b981;
        content: "";
      }
      .activity-empty {
        padding: 2rem 1rem;
        border: 1px dashed var(--bs-border-color);
        border-radius: .8rem;
        color: var(--bs-secondary-color);
        text-align: center;
      }
      .activity-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: .75rem;
      }
      #totalPagesText {
        margin: 0;
        color: var(--bs-secondary-color);
        font-size: .82rem;
      }
      #paginationNav .pagination {
        gap: .2rem;
        margin: 0;
      }
      #paginationNav .page-link {
        min-width: 2.2rem;
        border-radius: .55rem !important;
        border-color: var(--bs-border-color);
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
        text-align: center;
      }
      #paginationNav .page-item.active .page-link {
        border-color: #2563eb;
        background: #2563eb;
        color: #fff;
      }
      #paginationNav .page-link:focus {
        box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .2);
      }

      @media (prefers-reduced-motion: reduce) {
        #metricsRow .metric-card {
          transition: none;
        }
        #metricsRow .metric-card:hover {
          transform: none;
        }
      }

    .ai-assist-input-wrap {
        display: flex;
        gap: 0.35rem;
      }

      .ai-assist-input-wrap textarea {
        resize: none;
        height: 40px;
        max-height: 64px;
        font-size: 0.8rem;
      }

      .ai-assist-send {
        border-radius: 999px;
        border: 1px solid rgba(56,189,248,0.8);
        background: linear-gradient(135deg, #22c55e, #0ea5e9);
        color: #0b1120;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0 0.7rem;
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
      }

      .ai-assist-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: 0.35rem;
        margin-top: 0.5rem;
      }

      .ai-assist-chip {
        background-color: #e5e7eb;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        cursor: pointer;
      }

      .ai-assist-chip:hover {
        background-color: #d3d9df;
      }

      #roleDistRow .role-dist-item{
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.35rem 0;
        border-bottom:1px dashed rgba(148,163,184,0.4);
      }
      #roleDistRow .role-dist-item:last-child{border-bottom:none;}
      #roleDistRow .role-dist-name{
        width: 160px;
        max-width: 160px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      #roleDistRow .role-dist-right{flex:1;}
      #roleDistRow .role-dist-meta{
        display:flex;
        justify-content:space-between;
        font-size:0.85rem;
        opacity:0.9;
        margin-bottom:0.25rem;
      }
      #roleDistRow .role-dist-progress{
        width:100%;
        height:10px;
        border-radius:999px;
        background:rgba(148,163,184,0.25);
        overflow:hidden;
      }
      #roleDistRow .role-dist-bar{
        height:100%;
        border-radius:999px;
        transition:width 0.35s ease;
      }

      #cashpickupDistRow .role-dist-item{
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.35rem 0;
        border-bottom:1px dashed rgba(148,163,184,0.4);
      }
      #cashpickupDistRow .role-dist-item:last-child{border-bottom:none;}
      #cashpickupDistRow .role-dist-name{
        width: 160px;
        max-width: 160px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      #cashpickupDistRow .role-dist-right{flex:1;}
      #cashpickupDistRow .role-dist-meta{
        display:flex;
        justify-content:space-between;
        font-size:0.85rem;
        opacity:0.9;
        margin-bottom:0.25rem;
      }
      #cashpickupDistRow .role-dist-progress{
        width:100%;
        height:10px;
        border-radius:999px;
        background:rgba(148,163,184,0.25);
        overflow:hidden;
      }
      #cashpickupDistRow .role-dist-bar{
        height:100%;
        border-radius:999px;
        transition:width 0.35s ease;
      }

      #agencyDistRow .role-dist-item{
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.35rem 0;
        border-bottom:1px dashed rgba(148,163,184,0.4);
      }
      #agencyDistRow .role-dist-item:last-child{border-bottom:none;}
      #agencyDistRow .role-dist-name{
        width: 160px;
        max-width: 160px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      #agencyDistRow .role-dist-right{flex:1;}
      #agencyDistRow .role-dist-meta{
        display:flex;
        justify-content:space-between;
        font-size:0.85rem;
        opacity:0.9;
        margin-bottom:0.25rem;
      }
      #agencyDistRow .role-dist-progress{
        width:100%;
        height:10px;
        border-radius:999px;
        background:rgba(148,163,184,0.25);
        overflow:hidden;
      }
      #agencyDistRow .role-dist-bar{
        height:100%;
        border-radius:999px;
        transition:width 0.35s ease;
      }

      #agencyDistRow .ab-user-group{padding:0.35rem 0;border-bottom:1px dashed rgba(148,163,184,0.35);} 
      #agencyDistRow .ab-user-group:last-child{border-bottom:none;}
      #agencyDistRow .ab-user-title{display:flex;align-items:center;justify-content:space-between;gap:0.5rem;font-weight:700;cursor:pointer;}
      #agencyDistRow .ab-user-title .ab-user-name{flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
      #agencyDistRow .ab-user-title .ab-user-total{white-space:nowrap;opacity:0.95;}
      #agencyDistRow .ab-user-chevron{display:inline-block;margin-left:8px;opacity:0.85;transition:transform 0.2s ease;}
      #agencyDistRow .ab-user-group.is-open > .ab-user-title .ab-user-chevron{transform:rotate(90deg);}
      #agencyDistRow .ab-user-sub{margin-top:0.35rem;display:none;}
      #agencyDistRow .ab-user-group.is-open > .ab-user-sub{display:block;}
      #agencyDistRow .ab-user-line{display:flex;align-items:flex-start;justify-content:space-between;gap:0.5rem;font-size:0.85rem;opacity:0.95;padding:0.18rem 0;}
      #agencyDistRow .ab-user-line .ab-user-label{flex:1;min-width:0;white-space:normal;overflow:visible;line-height:1.2;}
      #agencyDistRow .ab-user-line .ab-user-amt{white-space:nowrap;opacity:0.95;}
      #agencyDistRow .ab-user-mini{height:8px;border-radius:999px;background:rgba(148,163,184,0.22);overflow:hidden;margin-top:0.15rem;}
      #agencyDistRow .ab-user-mini > div{height:100%;border-radius:999px;}

      #momoDistRow .role-dist-item{
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.35rem 0;
        border-bottom:1px dashed rgba(148,163,184,0.4);
      }
      #momoDistRow .role-dist-item:last-child{border-bottom:none;}
      #momoDistRow .role-dist-name{
        width: 160px;
        max-width: 160px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      #momoDistRow .role-dist-right{flex:1;}
      #momoDistRow .role-dist-meta{
        display:flex;
        justify-content:space-between;
        font-size:0.85rem;
        opacity:0.9;
        margin-bottom:0.25rem;
      }
      #momoDistRow .role-dist-progress{
        width:100%;
        height:10px;
        border-radius:999px;
        background:rgba(148,163,184,0.25);
        overflow:hidden;
      }
      #momoDistRow .role-dist-bar{
        height:100%;
        border-radius:999px;
        transition:width 0.35s ease;
      }

      #momoDistRow .ab-user-group{padding:0.35rem 0;border-bottom:1px dashed rgba(148,163,184,0.35);} 
      #momoDistRow .ab-user-group:last-child{border-bottom:none;}
      #momoDistRow .ab-user-title{display:flex;align-items:center;justify-content:space-between;gap:0.5rem;font-weight:700;cursor:pointer;}
      #momoDistRow .ab-user-title .ab-user-name{flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
      #momoDistRow .ab-user-title .ab-user-total{white-space:nowrap;opacity:0.95;}
      #momoDistRow .ab-user-chevron{display:inline-block;margin-left:8px;opacity:0.85;transition:transform 0.2s ease;}
      #momoDistRow .ab-user-group.is-open > .ab-user-title .ab-user-chevron{transform:rotate(90deg);}
      #momoDistRow .ab-user-sub{margin-top:0.35rem;display:none;}
      #momoDistRow .ab-user-group.is-open > .ab-user-sub{display:block;}
      #momoDistRow .ab-user-line{display:flex;align-items:flex-start;justify-content:space-between;gap:0.5rem;font-size:0.85rem;opacity:0.95;padding:0.18rem 0;}
      #momoDistRow .ab-user-line .ab-user-label{flex:1;min-width:0;white-space:normal;overflow:visible;line-height:1.2;}
      #momoDistRow .ab-user-line .ab-user-amt{white-space:nowrap;opacity:0.95;}
      #momoDistRow .ab-user-mini{height:8px;border-radius:999px;background:rgba(148,163,184,0.22);overflow:hidden;margin-top:0.15rem;}
      #momoDistRow .ab-user-mini > div{height:100%;border-radius:999px;}

      #airtimeDistRow .role-dist-item{
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.35rem 0;
        border-bottom:1px dashed rgba(148,163,184,0.4);
      }
      #airtimeDistRow .role-dist-item:last-child{border-bottom:none;}
      #airtimeDistRow .role-dist-name{
        width: 160px;
        max-width: 160px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      #airtimeDistRow .role-dist-right{flex:1;}
      #airtimeDistRow .role-dist-meta{
        display:flex;
        justify-content:space-between;
        font-size:0.85rem;
        opacity:0.9;
        margin-bottom:0.25rem;
      }
      #airtimeDistRow .role-dist-progress{
        width:100%;
        height:10px;
        border-radius:999px;
        background:rgba(148,163,184,0.25);
        overflow:hidden;
      }
      #airtimeDistRow .role-dist-bar{
        height:100%;
        border-radius:999px;
        transition:width 0.35s ease;
      }

      #airtimeDistRow .ab-user-group{padding:0.35rem 0;border-bottom:1px dashed rgba(148,163,184,0.35);} 
      #airtimeDistRow .ab-user-group:last-child{border-bottom:none;}
      #airtimeDistRow .ab-user-title{display:flex;align-items:center;justify-content:space-between;gap:0.5rem;font-weight:700;cursor:pointer;}
      #airtimeDistRow .ab-user-title .ab-user-name{flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
      #airtimeDistRow .ab-user-title .ab-user-total{white-space:nowrap;opacity:0.95;}
      #airtimeDistRow .ab-user-chevron{display:inline-block;margin-left:8px;opacity:0.85;transition:transform 0.2s ease;}
      #airtimeDistRow .ab-user-group.is-open > .ab-user-title .ab-user-chevron{transform:rotate(90deg);}
      #airtimeDistRow .ab-user-sub{margin-top:0.35rem;display:none;}
      #airtimeDistRow .ab-user-group.is-open > .ab-user-sub{display:block;}
      #airtimeDistRow .ab-user-line{display:flex;align-items:flex-start;justify-content:space-between;gap:0.5rem;font-size:0.85rem;opacity:0.95;padding:0.18rem 0;}
      #airtimeDistRow .ab-user-line .ab-user-label{flex:1;min-width:0;white-space:normal;overflow:visible;line-height:1.2;}
      #airtimeDistRow .ab-user-line .ab-user-amt{white-space:nowrap;opacity:0.95;}
      #airtimeDistRow .ab-user-mini{height:8px;border-radius:999px;background:rgba(148,163,184,0.22);overflow:hidden;margin-top:0.15rem;}
      #airtimeDistRow .ab-user-mini > div{height:100%;border-radius:999px;}

      #returningAnalytics .returning-card {
        border: 1px solid rgba(148,163,184,0.28);
        border-radius: 0.9rem;
        padding: 0.7rem 0.8rem;
        background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(248,250,252,0.95));
        box-shadow: 0 8px 20px rgba(15,23,42,0.06);
      }
      [data-bs-theme="dark"] #returningAnalytics .returning-card {
        background: linear-gradient(135deg, rgba(15,23,42,0.98), rgba(30,41,59,0.95));
        border-color: rgba(148,163,184,0.35);
      }
      #returningAnalytics .returning-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.65rem;
        cursor: pointer;
        width: 100%;
        border: none;
        background: transparent;
        padding: 0;
        color: inherit;
      }
      #returningAnalytics .returning-title {
        font-weight: 700;
        line-height: 1.2;
      }
      #returningAnalytics .returning-meta {
        font-size: 0.8rem;
        opacity: 0.85;
      }
      #returningAnalytics .returning-head .expand-icon {
        display: inline-block;
        transition: transform 0.2s ease;
      }
      #returningAnalytics .returning-head[aria-expanded="true"] .expand-icon {
        transform: rotate(180deg);
      }
      #returningAnalytics .returning-section {
        border: 1px solid rgba(148,163,184,0.18);
        border-radius: 0.9rem;
        padding: 0.85rem;
        background: rgba(255,255,255,0.85);
      }
      [data-bs-theme="dark"] #returningAnalytics .returning-section {
        background: rgba(15,23,42,0.85);
      }
      #returningAnalytics .returning-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        width: 100%;
        border: none;
        background: transparent;
        padding: 0;
        margin-bottom: 0.85rem;
        color: inherit;
      }
      #returningAnalytics .returning-section-title {
        font-weight: 700;
      }
      #returningAnalytics .returning-section-meta {
        font-size: 0.85rem;
        opacity: 0.85;
      }
      #returningAnalytics .returning-section-header .section-toggle {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        border: none;
        background: transparent;
        color: inherit;
        padding: 0;
        cursor: pointer;
      }
      #returningAnalytics .returning-section-header .section-toggle .expand-icon {
        transition: transform 0.2s ease;
      }
      #returningAnalytics .returning-section-header .section-toggle[aria-expanded="true"] .expand-icon {
        transform: rotate(180deg);
      }
      #returningAnalytics .returning-progress {
        height: 8px;
        border-radius: 999px;
        overflow: hidden;
        background: rgba(148,163,184,0.18);
        margin-top: 0.45rem;
      }
      #returningAnalytics .returning-progress > div {
        height: 100%;
        border-radius: inherit;
      }
      #returningAnalytics .returning-detail {
        margin-top: 0.55rem;
        padding-top: 0.55rem;
        border-top: 1px dashed rgba(148,163,184,0.25);
        font-size: 0.92rem;
        opacity: 0.88;
      }
      #returningAnalytics .returning-detail-item {
        padding: 0.35rem 0;
        border-bottom: 1px dashed rgba(148,163,184,0.18);
      }
      #returningAnalytics .returning-detail-item:last-child {
        border-bottom: none;
      }
      #returningAnalytics .returning-detail-item .fw-semibold {
        font-size: 0.95rem;
        font-weight: 600;
      }
      #returningAnalytics .returning-detail-item .small {
        opacity: 0.75;
      }

  .select2-container--default .select2-selection--multiple,
  .select2-container--default .select2-selection--single {
    background: #f8fafc;
    border-color: rgba(148, 163, 184, 0.6);
    color: #0f172a;
  }
  .select2-container--default .select2-selection__rendered {
    color: #0f172a;
  }
  .select2-container--default .select2-selection__choice {
    background-color: #e2e8f0;
    border: 1px solid rgba(148, 163, 184, 0.5);
    color: #0f172a;
  }
  .select2-container--default .select2-selection__choice__remove {
    color: #475569;
  }
  .select2-container--default .select2-results__option {
    color: #0f172a;
    background: #fff;
  }
  .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: #2563eb;
    color: #fff;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection--multiple,
  [data-bs-theme="dark"] .select2-container--default .select2-selection--single {
    background: #0f172a;
    border-color: rgba(148, 163, 184, 0.25);
    color: #e2e8f0;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__rendered {
    color: #e2e8f0;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__choice {
    background-color: #1f2937;
    border-color: rgba(148, 163, 184, 0.25);
    color: #e2e8f0;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__choice__remove {
    color: #94a3b8;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-results__option {
    background: #0f172a;
    color: #e2e8f0;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: #2563eb;
    color: #fff;
  }
</style>

<link href="<?=plugin_http_path('assets/css/select2.min.css')?>" rel="stylesheet">
<link href="<?=plugin_http_path('assets/css/dataTables.bootstrap5.min.css')?>" rel="stylesheet">
<style>
  .select2-container--default .select2-selection--multiple,
  .select2-container--default .select2-selection--single {
    background: #f8fafc !important;
    border-color: rgba(148, 163, 184, 0.6) !important;
    color: #0f172a !important;
  }
  .select2-container--default .select2-selection__rendered {
    color: #0f172a !important;
  }
  .select2-container--default .select2-selection__choice {
    background-color: #e2e8f0 !important;
    border: 1px solid rgba(148, 163, 184, 0.5) !important;
    color: #0f172a !important;
  }
  .select2-container--default .select2-selection__choice__remove {
    color: #475569 !important;
  }
  .select2-container--default .select2-results__option {
    color: #0f172a !important;
    background: #fff !important;
  }
  .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: #2563eb !important;
    color: #fff !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection--multiple,
  [data-bs-theme="dark"] .select2-container--default .select2-selection--single {
    background: #0f172a !important;
    border-color: rgba(148, 163, 184, 0.25) !important;
    color: #e2e8f0 !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__rendered {
    color: #e2e8f0 !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__choice {
    background-color: #1f2937 !important;
    border-color: rgba(148, 163, 184, 0.25) !important;
    color: #e2e8f0 !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-selection__choice__remove {
    color: #94a3b8 !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-results__option {
    background: #0f172a !important;
    color: #e2e8f0 !important;
  }
  [data-bs-theme="dark"] .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: #2563eb !important;
    color: #fff !important;
  }
  .dashboard-filter-panel {
    padding: clamp(1rem, 2vw, 1.5rem);
    border-radius: 1rem;
  }
  .dashboard-filter-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.1rem;
  }
  .dashboard-filter-tools {
    display: flex;
    align-items: center;
    gap: .65rem;
    flex: 0 0 auto;
  }
  .dashboard-filter-toggle {
    min-height: 38px;
    border-radius: .65rem;
    font-size: .82rem;
    font-weight: 600;
    white-space: nowrap;
  }
  .dashboard-filter-controls[hidden] {
    display: none !important;
  }
  .dashboard-filter-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: -0.02em;
  }
  .dashboard-filter-description {
    margin: .25rem 0 0;
    color: var(--bs-secondary-color);
    font-size: .9rem;
  }
  .dashboard-filter-count {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    flex: 0 0 auto;
    border: 1px solid rgba(37, 99, 235, .2);
    border-radius: 999px;
    padding: .35rem .7rem;
    color: #1d4ed8;
    background: rgba(37, 99, 235, .08);
    font-size: .8rem;
    font-weight: 600;
  }
  [data-bs-theme="dark"] .dashboard-filter-count {
    color: #bfdbfe;
    border-color: rgba(96, 165, 250, .28);
    background: rgba(37, 99, 235, .2);
  }
  .dashboard-filter-presets {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .45rem;
    margin-bottom: 1rem;
  }
  .dashboard-filter-presets-label {
    margin-right: .25rem;
    color: var(--bs-secondary-color);
    font-size: .8rem;
    font-weight: 600;
  }
  .dashboard-filter-preset {
    min-height: 34px;
    border: 1px solid var(--bs-border-color);
    border-radius: 999px;
    padding: .3rem .75rem;
    color: var(--bs-body-color);
    background: var(--bs-body-bg);
    font-size: .82rem;
    font-weight: 600;
    transition: color .15s ease, background-color .15s ease, border-color .15s ease;
  }
  .dashboard-filter-preset:hover {
    border-color: #2563eb;
    color: #1d4ed8;
  }
  .dashboard-filter-preset.active,
  .dashboard-filter-preset[aria-pressed="true"] {
    border-color: #2563eb;
    color: #fff;
    background: #2563eb;
  }
  [data-bs-theme="dark"] .dashboard-filter-preset:hover:not(.active) {
    color: #bfdbfe;
    background: rgba(37, 99, 235, .16);
  }
  .dashboard-filter-field .form-label {
    margin-bottom: .4rem;
    color: var(--bs-secondary-color);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .035em;
    text-transform: uppercase;
  }
  .dashboard-filter-field .form-control,
  .dashboard-filter-field .select2-container--default .select2-selection--multiple {
    min-height: 44px;
    border: 1px solid var(--bs-border-color);
    border-radius: .65rem;
    box-shadow: none;
  }
  .dashboard-filter-field .form-control:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .14);
  }
  .dashboard-filter-field .select2-container {
    width: 100% !important;
  }
  .dashboard-filter-field .select2-container--default .select2-selection--multiple {
    display: flex;
    align-items: center;
    padding: .25rem .4rem;
  }
  .dashboard-filter-field .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    display: flex;
    flex-wrap: wrap;
    gap: .25rem;
    padding: 0;
  }
  .dashboard-filter-field .select2-container--default .select2-selection--multiple .select2-selection__choice {
    margin: 0;
    border-radius: .4rem;
    padding: .15rem .35rem;
    font-size: .78rem;
  }
  .dashboard-filter-actions {
    display: flex;
    align-items: center;
    gap: .55rem;
  }
  .dashboard-filter-actions .btn {
    min-height: 44px;
    border-radius: .65rem;
    font-weight: 600;
    white-space: nowrap;
  }
  .dashboard-filter-feedback {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .75rem;
    min-height: 1.5rem;
    margin: -.25rem 0 1rem;
    color: var(--bs-secondary-color);
    font-size: .82rem;
  }
  .dashboard-filter-feedback [data-state="error"] {
    color: var(--bs-danger);
  }
  @media (max-width: 575.98px) {
    .dashboard-filter-heading {
      align-items: flex-start;
    }
    .dashboard-filter-tools {
      align-items: flex-end;
      flex-direction: column-reverse;
    }
    .dashboard-filter-toggle {
      min-height: 34px;
      padding: .3rem .55rem;
    }
    .dashboard-filter-presets {
      flex-wrap: nowrap;
      overflow-x: auto;
      padding-bottom: .35rem;
      scrollbar-width: thin;
    }
    .dashboard-filter-preset {
      flex: 0 0 auto;
    }
    .dashboard-filter-actions {
      display: grid;
      grid-template-columns: 1fr auto;
    }
    .dashboard-filter-feedback {
      align-items: flex-start;
      flex-direction: column;
    }
    .activity-header,
    .activity-footer {
      align-items: stretch;
      flex-direction: column;
    }
    .activity-search {
      width: 100%;
      flex-basis: auto;
    }
    #paginationNav .pagination {
      justify-content: flex-start !important;
      flex-wrap: wrap;
    }
  }
</style>

<?php if(user_can('view_dashboard')):?>

<div class="container-fluid py-3">

    <!-- Header & Filters -->
    <section class="card-ash dashboard-filter-panel mb-4" aria-labelledby="dashboardFilterTitle">
      <div class="dashboard-filter-heading">
        <div>
          <h2 class="dashboard-filter-title" id="dashboardFilterTitle">Filter dashboard</h2>
          <p class="dashboard-filter-description">Choose a period or narrow results by team and activity.</p>
        </div>
        <div class="dashboard-filter-tools">
          <span class="dashboard-filter-count" id="dashboardFilterCount" aria-live="polite">
            <i class="fa fa-sliders" aria-hidden="true"></i><span>All data</span>
          </span>
          <button type="button" class="btn btn-outline-secondary dashboard-filter-toggle" id="toggleDashboardFilters" aria-expanded="false" aria-controls="dashboardFilterControls">
            <i class="fa fa-eye me-1" aria-hidden="true"></i><span>Show filters</span>
          </button>
        </div>
      </div>

      <div class="dashboard-filter-feedback">
        <span id="dashboardFilterSummary" aria-live="polite">Showing all available data</span>
        <span id="dashboardFilterStatus" role="status" aria-live="polite"></span>
      </div>

      <div class="dashboard-filter-controls" id="dashboardFilterControls" hidden>
        <div class="dashboard-filter-presets" role="group" aria-label="Quick date ranges">
          <span class="dashboard-filter-presets-label">Quick range</span>
          <button type="button" class="dashboard-filter-preset active" data-dashboard-range="all" aria-pressed="true">All time</button>
          <button type="button" class="dashboard-filter-preset" data-dashboard-range="today" aria-pressed="false">Today</button>
          <button type="button" class="dashboard-filter-preset" data-dashboard-range="7" aria-pressed="false">Last 7 days</button>
          <button type="button" class="dashboard-filter-preset" data-dashboard-range="30" aria-pressed="false">Last 30 days</button>
          <button type="button" class="dashboard-filter-preset" data-dashboard-range="month" aria-pressed="false">This month</button>
        </div>

        <div class="row g-3 align-items-end">
        <div class="col-12 col-sm-6 col-xl-2 dashboard-filter-field">
          <label class="form-label" for="globalStart">From date</label>
          <input type="date" id="globalStart" class="form-control" autocomplete="off">
        </div>
        <div class="col-12 col-sm-6 col-xl-2 dashboard-filter-field">
          <label class="form-label" for="globalEnd">To date</label>
          <input type="date" id="globalEnd" class="form-control" autocomplete="off">
        </div>
        <?php if (user_can('is_manager') || user_can('is_admin')): ?>
        <div class="col-12 col-md-6 col-xl-3 dashboard-filter-field">
          <label class="form-label" for="userFilter">Team members</label>
          <select id="userFilter" name="users[]" class="form-select select2" multiple data-placeholder="All team members">
            <?php foreach($users as $u): ?>
              <option value="<?=htmlspecialchars((string)$u->id, ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($u->first_name . ' '. $u->last_name, ENT_QUOTES, 'UTF-8')?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <?php endif; ?>
        <div class="col-12 col-md-6 <?= (user_can('is_manager') || user_can('is_admin')) ? 'col-xl-3' : 'col-xl-6' ?> dashboard-filter-field">
          <label class="form-label" for="activityFilter">Activity type</label>
          <select id="activityFilter" name="activity[]" class="form-select select2" multiple data-placeholder="All activity types">
            <?php foreach($activityTypes as $act): ?>
              <option value="<?=htmlspecialchars((string)$act, ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars(ucwords(str_replace('_',' ',(string)$act)), ENT_QUOTES, 'UTF-8')?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-12 col-xl-2">
          <div class="dashboard-filter-actions">
            <button type="button" id="applyFilters" class="btn btn-primary flex-grow-1">
              <i class="fa fa-filter me-1" aria-hidden="true"></i><span>Apply filters</span>
            </button>
            <button type="button" id="resetFilters" class="btn btn-outline-secondary" title="Clear all filters" aria-label="Clear all filters">
              <i class="fa fa-rotate-left" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        </div>
      </div>
    </section>

    <!-- Key Metrics -->
    <div class="row mb-4" id="metricsRow"></div>

    <?php if (user_can('is_manager') || user_can('is_admin')): ?>
    <div class="row mb-4" id="returningAnalytics">
      <div class="col-12">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="chart-header">Returning Customer Analytics</div>
            <div class="opacity-75 small">Tracked by phone number across service transactions</div>
          </div>
          <div class="row g-3">
            <div class="col-lg-4">
              <div class="returning-section">
                <button class="returning-section-header" type="button" data-bs-toggle="collapse" data-bs-target="#returningServiceSection" aria-expanded="false" aria-controls="returningServiceSection">
                  <span class="returning-section-title">By Service</span>
                  <span class="returning-section-meta">Tap to expand / collapse</span>
                  <span class="section-toggle" aria-expanded="false"><i class="fa fa-chevron-down expand-icon"></i></span>
                </button>
                <div id="returningServiceSection" class="collapse">
                  <div id="returningServiceBody" class="d-flex flex-column gap-2"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="returning-section">
                <button class="returning-section-header" type="button" data-bs-toggle="collapse" data-bs-target="#returningCustomerSection" aria-expanded="false" aria-controls="returningCustomerSection">
                  <span class="returning-section-title">Top Customers</span>
                  <span class="returning-section-meta">Tap to expand / collapse</span>
                  <span class="section-toggle" aria-expanded="false"><i class="fa fa-chevron-down expand-icon"></i></span>
                </button>
                <div id="returningCustomerSection" class="collapse">
                  <div id="returningCustomerBody" class="d-flex flex-column gap-2"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="returning-section">
                <button class="returning-section-header" type="button" data-bs-toggle="collapse" data-bs-target="#returningAgentSection" aria-expanded="false" aria-controls="returningAgentSection">
                  <span class="returning-section-title">Top Agents</span>
                  <span class="returning-section-meta">Tap to expand / collapse</span>
                  <span class="section-toggle" aria-expanded="false"><i class="fa fa-chevron-down expand-icon"></i></span>
                </button>
                <div id="returningAgentSection" class="collapse">
                  <div id="returningAgentBody" class="d-flex flex-column gap-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

      <div class="row mb-4">
          <!-- Role Distribution -->

        <div class="col-lg-6" id="roleDistRow" style="display:none;">
          <div class="card-ash p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="chart-header">Role Distribution</div>
              <div id="roleDistTotal" style="opacity:0.85;font-size:0.9rem;"></div>
            </div>
            <div id="roleDistBody"></div>
          </div>
        </div>

        <!-- Cashpickup Status Distribution -->
        <div class="col-lg-6" id="cashpickupDistRow" style="display:none;">
          <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Cashpickup Status</div>
            <div id="cashpickupDistTotal" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <div id="cashpickupDistBody"></div>
        </div>
      </div>
    </div>

    <!-- Agency Banking Distribution -->
    <div class="row mb-4" id="agencyDistRow" style="display:none;">
      <div class="col-lg-12">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Agency Banking Clearing</div>
            <div id="agencyDistTotal" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-3 mb-lg-0 px-3">
              <div class="fw-semibold" style="opacity:0.9;">By Network</div>
              <div id="agencyDistNetTypeBody"></div>
            </div>
            <div class="col-lg-6">
              <div class="fw-semibold" style="opacity:0.9;">Created By (Top 5 Staff)</div>
              <div id="agencyDistUserBody"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Momo Remits Distribution -->
    <div class="row mb-4" id="momoDistRow" style="display:none;">
      <div class="col-lg-12">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Momo Remits Clearing</div>
            <div id="momoDistTotal" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-3 mb-lg-0 px-3">
              <div class="fw-semibold" style="opacity:0.9;">By Network</div>
              <div id="momoDistNetTypeBody"></div>
            </div>
            <div class="col-lg-6">
              <div class="fw-semibold" style="opacity:0.9;">Created By (Top 5 Staff)</div>
              <div id="momoDistUserBody"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Airtimebundle Distribution -->
    <div class="row mb-4" id="airtimeDistRow" style="display:none;">
      <div class="col-lg-12">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Airtimebundle Clearing</div>
            <div id="airtimeDistTotal" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-3 mb-lg-0 px-3">
              <div class="fw-semibold" style="opacity:0.9;">By Network</div>
              <div id="airtimeDistNetTypeBody"></div>
            </div>
            <div class="col-lg-6">
              <div class="fw-semibold" style="opacity:0.9;">Created By (Top 5 Staff)</div>
              <div id="airtimeDistUserBody"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-4" id="opsInsightsRow" style="display:none;">
      <div class="col-lg-4 mb-3" id="svcCatCard" style="display:none;">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Payment Services</div>
            <div id="svcCatTotal" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <div class="fw-semibold" style="opacity:0.9;">By Category</div>
          <div id="svcCatBody"></div>
        </div>
      </div>

      <div class="col-lg-4 mb-3" id="ticketsStatusCard" style="display:none;">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Tickets</div>
            <div id="ticketsMeta" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <canvas id="chartTicketsStatus" height="170"></canvas>
        </div>
      </div>

      <div class="col-lg-4 mb-3" id="requestsHealthCard" style="display:none;">
        <div class="card-ash p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="chart-header">Requests Health</div>
            <div id="requestsMeta" style="opacity:0.85;font-size:0.9rem;"></div>
          </div>
          <canvas id="chartRequestsFailures" height="170"></canvas>
        </div>
      </div>
    </div>
    
    <!-- Charts Row 2 -->
    <div class="row mb-4">
      <div class="col-lg-6 mb-3">
        <div class="card-ash p-3">
          <div class="chart-header">Days Worked</div>
          <div id="attendanceProgBody"></div>
          <canvas id="chartAttendance" height="150" style="display:none;"></canvas>
        </div>
      </div>
      <div class="col-lg-6 mb-3">
        <div class="card-ash p-3">
          <div class="chart-header">Cashpickup Overview</div>
          <canvas id="chartCashpickupOverview" height="150"></canvas>
        </div>
      </div>
    </div>  

    <div class="row mb-4">
        <!-- Recent Activities Log (full-width) -->
        <div class="col-lg-12 col-md-12 mb-5">
          <div class="card-ash p-3">
            <div class="recent-activities">
                <div class="activity-header">
                  <div class="activity-heading">
                    <span class="activity-heading-icon" aria-hidden="true"><i class="fa fa-clock-rotate-left"></i></span>
                    <div>
                      <h3 id="activityTitle">Recent Activities Log</h3>
                      <p>Latest actions across your workspace <span class="activity-record-count" id="activityRecordCount" aria-live="polite"></span></p>
                    </div>
                  </div>
                  <label class="activity-search">
                    <span class="visually-hidden">Search recent activities</span>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="search" id="activitySearch" class="form-control" placeholder="Search activities..." autocomplete="off" aria-controls="activityTable">
                  </label>
                </div>
                <div class="activity-table-wrap">
                  <table class="table activity-table" aria-labelledby="activityTitle">
                    <thead>
                      <tr>
                        <th scope="col">Date/Time</th>
                        <th scope="col">Description</th>
                      </tr>
                    </thead>
                    <tbody id="activityTable">
                      <?php if (!empty($recentActivities)): ?>
                          <?php foreach ($recentActivities as $activity): ?>
                            <tr>
                              <td class="activity-date">
                                <span class="activity-date-badge"><i class="fa fa-calendar-day" aria-hidden="true"></i><?= get_date_time($activity->date_created); ?></span>
                              </td>
                              <td class="activity-description"><?= htmlspecialchars($activity->description); ?></td>
                            </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <div class="activity-empty" id="activityEmptyState" hidden>No recent activities to show.</div>
                <div class="activity-footer">
                  <p id="totalPagesText" aria-live="polite"></p>
                  <nav id="paginationNav" aria-label="Recent activities pages">
                    <ul class="pagination justify-content-end"></ul>
                  </nav>
                </div>
            </div>
          </div>
        </div>
    </div>

  </div>

<!-- Dependencies -->
<script src="<?=plugin_http_path('assets/js/jquery-3.6.0.min.js')?>"></script>
<script src="<?=plugin_http_path('assets/js/select2.min.js')?>"></script>
<script src="<?=plugin_http_path('assets/js/chart.js')?>"></script>
<script src="<?=plugin_http_path('assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=plugin_http_path('assets/js/dataTables.bootstrap5.min.js')?>"></script>

<!-- Scripts -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const rowsPerPage = 5;
      const table = document.getElementById("activityTable");
      const paginationNav = document.querySelector("#paginationNav .pagination");
      const searchInput = document.getElementById("activitySearch");
      const totalPagesText = document.getElementById("totalPagesText");
      const emptyState = document.getElementById("activityEmptyState");
      const recordCount = document.getElementById("activityRecordCount");

      if (!table || !paginationNav) {
        return;
      }

      let currentPage = 1;
      const originalRows = Array.from(table.rows);
      let filteredRows = [...originalRows];

      function displayPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        filteredRows.forEach((row, index) => {
          row.style.display = index >= start && index < end ? "" : "none";
        });

        currentPage = page;
        updatePagination();
      }

      function updatePagination() {
        paginationNav.innerHTML = "";
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        const firstVisible = filteredRows.length ? ((currentPage - 1) * rowsPerPage) + 1 : 0;
        const lastVisible = Math.min(currentPage * rowsPerPage, filteredRows.length);
        if (recordCount) {
          recordCount.textContent = `${filteredRows.length} ${filteredRows.length === 1 ? "activity" : "activities"}`;
        }
        totalPagesText.textContent = filteredRows.length
          ? `Showing ${firstVisible}-${lastVisible} of ${filteredRows.length} activities`
          : (originalRows.length ? "No activities match your search." : "No recent activities to show.");
        if (emptyState) {
          emptyState.hidden = filteredRows.length > 0;
          if (filteredRows.length === 0) {
            emptyState.textContent = originalRows.length
              ? "No activities match your search."
              : "No recent activities to show.";
          }
        }
        const paginationRange = getPaginationRange(currentPage, totalPages);
        paginationRange.forEach((item) => {
          const li = document.createElement("li");
          li.className = "page-item" + (item === currentPage ? " active" : "");
          const a = document.createElement("a");
          a.className = "page-link";

          if (item === "...") {
            li.classList.add("disabled");
            a.textContent = "...";
            a.setAttribute("aria-hidden", "true");
          } else {
            a.textContent = item;
            a.href = "#";
            a.setAttribute("aria-label", `Page ${item}`);
            if (item === currentPage) a.setAttribute("aria-current", "page");
            a.addEventListener("click", (e) => {
              e.preventDefault();
              if (typeof item === "number") displayPage(item);
            });
          }

          li.appendChild(a);
          paginationNav.appendChild(li);
        });
      }

      function getPaginationRange(current, total) {
        const range = [];
        if (total <= 1) return range;
        if (total <= 5) {
          for (let i = 1; i <= total; i++) range.push(i);
          return range;
        }

        const start = Math.max(2, Math.min(current - 1, total - 3));
        const end = Math.min(total - 1, start + 2);
        range.push(1);
        if (start > 2) range.push("...");
        for (let i = start; i <= end; i++) range.push(i);
        if (end < total - 1) range.push("...");
        range.push(total);
        return range;
      }

      if (searchInput) {
        searchInput.addEventListener("input", function () {
          const query = searchInput.value.trim().toLocaleLowerCase();
          filteredRows = originalRows.filter((row) => row.textContent.toLocaleLowerCase().includes(query));
          displayPage(1);
        });
      }

      displayPage(1);
    });
  </script>
<script>
  const chartInstances = {};
  let dashboardRequest = null;
  let dashboardAppliedFilterState = null;
  let dashboardLastUpdatedAt = '';

  $(document).ready(function(){
    $('#toggleDashboardFilters').on('click', function(){
      const controls = document.getElementById('dashboardFilterControls');
      if (!controls) return;
      const expanded = $(this).attr('aria-expanded') === 'true';
      controls.hidden = expanded;
      $(this).attr('aria-expanded', expanded ? 'false' : 'true');
      $(this).find('i').toggleClass('fa-eye-slash', !expanded).toggleClass('fa-eye', expanded);
      $(this).find('span').text(expanded ? 'Show filters' : 'Hide filters');
    });

    $('.select2').each(function(){
      $(this).select2({
        width: '100%',
        allowClear: true,
        placeholder: $(this).data('placeholder') || 'Select options'
      });
    });

    $('#applyFilters').on('click', fetchDashboard);
    $('#resetFilters').on('click', function(){
      $('#globalStart, #globalEnd').val('');
      $('#userFilter, #activityFilter').val(null).trigger('change');
      syncDashboardDateConstraints();
      updateDashboardFilterSummary();
      fetchDashboard();
    });
    $('.dashboard-filter-preset').on('click', function(){
      const range = getDashboardDateRange($(this).attr('data-dashboard-range'));
      $('#globalStart').val(range.start);
      $('#globalEnd').val(range.end);
      syncDashboardDateConstraints();
      updateDashboardFilterSummary();
      fetchDashboard();
    });
    $('#globalStart, #globalEnd').on('change', function(){
      syncDashboardDateConstraints();
      updateDashboardFilterSummary();
    });
    $('#userFilter, #activityFilter').on('change', updateDashboardFilterSummary);

    syncDashboardDateConstraints();
    updateDashboardFilterSummary();
    fetchDashboard();
  });

  function localDateValue(date){
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  function getDashboardDateRange(range){
    const today = new Date();
    const end = localDateValue(today);
    if (range === 'today') return {start: end, end: end};
    if (range === 'month') {
      return {start: localDateValue(new Date(today.getFullYear(), today.getMonth(), 1)), end: end};
    }
    if (range === '7' || range === '30') {
      const days = Number(range);
      return {start: localDateValue(new Date(today.getFullYear(), today.getMonth(), today.getDate() - days + 1)), end: end};
    }
    return {start: '', end: ''};
  }

  function syncDashboardDateConstraints(){
    const start = $('#globalStart').val() || '';
    const end = $('#globalEnd').val() || '';
    $('#globalEnd').attr('min', start);
    $('#globalStart').attr('max', end);
    const invalid = Boolean(start && end && start > end);
    $('#globalStart, #globalEnd').attr('aria-invalid', invalid ? 'true' : 'false');
    return !invalid;
  }

  function updateDashboardFilterSummary(){
    const start = $('#globalStart').val() || '';
    const end = $('#globalEnd').val() || '';
    const users = $('#userFilter').length ? ($('#userFilter').val() || []) : [];
    const activities = $('#activityFilter').val() || [];
    const items = [];
    const formatDate = value => new Date(`${value}T12:00:00`).toLocaleDateString(undefined, {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    });

    if (start && end) {
      items.push(start === end ? formatDate(start) : `${formatDate(start)} – ${formatDate(end)}`);
    } else if (start) {
      items.push(`From ${formatDate(start)}`);
    } else if (end) {
      items.push(`Through ${formatDate(end)}`);
    }
    if (users.length) items.push(`${users.length} team member${users.length === 1 ? '' : 's'}`);
    if (activities.length) items.push(`${activities.length} activit${activities.length === 1 ? 'y' : 'ies'}`);

    const filterCount = items.length;
    $('#dashboardFilterSummary').text(filterCount ? `Filters selected: ${items.join(' · ')}` : 'Showing all available data');
    $('#dashboardFilterCount span').text(filterCount ? `${filterCount} active filter${filterCount === 1 ? '' : 's'}` : 'All data');

    if (dashboardAppliedFilterState !== null) {
      const state = getDashboardFilterState(getDashboardFilterPayload());
      const changed = state !== dashboardAppliedFilterState;
      $('#dashboardFilterStatus')
        .removeAttr('data-state')
        .text(changed ? 'Changes not applied' : dashboardLastUpdatedAt);
    }

    const currentRange = {start: start, end: end};
    $('.dashboard-filter-preset').each(function(){
      const preset = getDashboardDateRange($(this).attr('data-dashboard-range'));
      const active = preset.start === currentRange.start && preset.end === currentRange.end;
      $(this).toggleClass('active', active).attr('aria-pressed', active ? 'true' : 'false');
    });
  }

  function getDashboardFilterPayload(){
    const activities = $('#activityFilter').val() || [];
    const users = $('#userFilter').length ? ($('#userFilter').val() || []) : [];
    const payload = {
      start_date: $('#globalStart').val(),
      end_date: $('#globalEnd').val()
    };
    if (activities.length) payload.activity = activities;
    if (users.length) payload.users = users;
    return payload;
  }

  function getDashboardFilterState(payload){
    return JSON.stringify({
      start_date: payload.start_date || '',
      end_date: payload.end_date || '',
      activity: (payload.activity || []).slice().sort(),
      users: (payload.users || []).slice().sort()
    });
  }

  function fetchDashboard(){
    if (dashboardRequest && dashboardRequest.readyState !== 4) {
      const previousRequest = dashboardRequest;
      dashboardRequest = null;
      previousRequest.abort();
    }

    if (!syncDashboardDateConstraints()) {
      $('#dashboardFilterStatus').attr('data-state', 'error').text('The end date must be on or after the start date.');
      $('#globalEnd').trigger('focus');
      $('#applyFilters').prop('disabled', false).removeAttr('aria-busy').find('span').text('Apply filters');
      return;
    }

    const payload = getDashboardFilterPayload();
    const $applyButton = $('#applyFilters');
    $applyButton.prop('disabled', true).attr('aria-busy', 'true');
    $applyButton.find('span').text('Loading…');
    $('#dashboardFilterStatus').removeAttr('data-state').text('Updating dashboard…');

    const request = $.ajax({
      url: '<?=ROOT?>/admin/dashboard',
      method: 'POST',
      contentType: 'application/json',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      data: JSON.stringify(payload),
    });
    dashboardRequest = request;
    request.done(function(response){
        renderDashboard(response);
        dashboardAppliedFilterState = getDashboardFilterState(payload);
        dashboardLastUpdatedAt = `Updated ${new Date().toLocaleTimeString([], {hour: 'numeric', minute: '2-digit'})}`;
        updateDashboardFilterSummary();
    });
    request.fail(function(xhr, textStatus) {
        if (textStatus === 'abort') return;
        const responseText = String(xhr.responseText || '').trim();
        let message = 'Unable to load dashboard metrics.';
        try {
          const response = JSON.parse(responseText);
          message = response.message || message;
        } catch (error) {
          if ((xhr.getResponseHeader('Content-Type') || '').includes('text/html')) {
            message = 'The server returned an HTML page. Your session may have expired; refresh and sign in again.';
          }
        }
        console.error('Dashboard fetch error:', xhr.status, message);
      $('#dashboardFilterStatus').attr('data-state', 'error').text(message);
    });
    request.always(function(){
      if (dashboardRequest !== request) return;
      dashboardRequest = null;
      $applyButton.prop('disabled', false).removeAttr('aria-busy');
      $applyButton.find('span').text('Apply filters');
    });
  }

  function toggleChartCard(chartId, hasData) {
    const $canvas = $('#' + chartId);
    if (!$canvas.length) return;
    const $col = $canvas.closest('div[class*="col-"]');
    if (hasData) {
      $col.show();
      return;
    }
    if (chartInstances[chartId]) {
      chartInstances[chartId].destroy();
      delete chartInstances[chartId];
    }
    const ctx = $canvas[0].getContext('2d');
    ctx.clearRect(0, 0, $canvas[0].width, $canvas[0].height);
    $col.hide();
  }

  function renderRoleDistribution(topRolesArr, totalUsers) {
    try {
      const $row = $('#roleDistRow');
      const $body = $('#roleDistBody');
      const $ttl = $('#roleDistTotal');

      const rows = (Array.isArray(topRolesArr) ? topRolesArr : [])
        .filter(r => r && (r.role || r.cnt))
        .map(r => ({
          role: String(r.role || 'Unassigned'),
          cnt: parseInt(r.cnt, 10) || 0
        }))
        .filter(r => r.cnt > 0);

      if (!rows.length) {
        $row.hide();
        $body.empty();
        $ttl.text('');
        return;
      }

      $row.show();
      const sum = rows.reduce((s, r) => s + (parseInt(r.cnt, 10) || 0), 0);
      const total = (parseInt(totalUsers, 10) || 0) > 0 ? (parseInt(totalUsers, 10) || 0) : sum;
      $ttl.text(total ? `${Number(total).toLocaleString()} users` : '');

      const denom = total > 0 ? total : 1;
      const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1','#f97316'];

      const html = rows.slice(0, 10).map((r, idx) => {
        const pct = Math.round((r.cnt / denom) * 100);
        const safeRole = $('<div>').text(r.role).html();
        return `
          <div class="role-dist-item">
            <div class="role-dist-name" title="${safeRole}">${safeRole}</div>
            <div class="role-dist-right">
              <div class="role-dist-meta">
                <span>${Number(r.cnt).toLocaleString()}</span>
                <span>${pct}%</span>
              </div>
              <div class="role-dist-progress">
                <div class="role-dist-bar" style="width:${pct}%;background:${palette[idx % palette.length]};"></div>
              </div>
            </div>
          </div>
        `;
      }).join('');

      $body.html(html);
    } catch (e) {
    }
  }

  function renderCashpickupStatusDistribution(counts, out, meta) {
    try {
      const $row = $('#cashpickupDistRow');
      const $body = $('#cashpickupDistBody');
      const $ttl = $('#cashpickupDistTotal');

      const totalFromMeta = parseInt(meta?.cashpickups_total, 10) || 0;

      const statusColor = {
        approved: '#22c55e',
        pending: '#f59e0b',
        draft: '#a855f7',
        denied: '#ef4444',
        paid_out: '#0ea5e9',
        other: '#0ea5e9',
      };

      const normSide = (s) => {
        const v = String(s || '').toLowerCase().trim();
        if (v === 'receive') return 'Receive';
        if (v === 'pay') return 'Pay';
        if (!v) return '';
        return v.replace(/\b\w/g, c => c.toUpperCase());
      };
      const normApprovalKey = (s) => {
        const v = String(s || '').toLowerCase().trim();
        if (!v) return 'pending';
        if (v === 'approved') return 'approved';
        if (v === 'pending') return 'pending';
        if (v === 'draft') return 'draft';
        if (v === 'denied') return 'denied';
        return 'other';
      };
      const labelForApproval = (key, raw) => {
        if (key === 'approved') return 'Approved';
        if (key === 'pending') return 'Pending';
        if (key === 'draft') return 'Draft';
        if (key === 'denied') return 'Denied';
        const t = String(raw || '').trim();
        return t ? t : 'Other';
      };

      const pending = parseInt(counts?.pending, 10) || 0;
      const approved = parseInt(counts?.approved, 10) || 0;
      const paidOut = parseInt(counts?.paid_out, 10) || 0;

      const fmtAmt = (v) => `₵${Number(parseFloat(v || 0) || 0).toLocaleString()}`;

      const sideApproval = out?.cashpickups?.By_Side_Approval || [];
      const byStatus = out?.cashpickups?.By_Status || [];

      // Prefer direction-aware breakdown when available
      let rows = [];
      if (Array.isArray(sideApproval) && sideApproval.length) {
        const agg = new Map();
        sideApproval.forEach((r) => {
          const side = normSide(r?.side);
          const key = normApprovalKey(r?.status);
          const lbl = labelForApproval(key, r?.status);
          const cnt = parseInt(r?.total_count, 10) || 0;
          const amt = parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0;
          if (!cnt) return;
          const k = `${side}||${key}||${lbl}`;
          const cur = agg.get(k) || { cnt: 0, amt: 0 };
          cur.cnt += cnt;
          cur.amt += amt;
          agg.set(k, cur);
        });
        rows = Array.from(agg.entries()).map(([k, v]) => {
          const [side, key, lbl] = k.split('||');
          const name = side ? `${side} — ${lbl}` : lbl;
          return { name, cnt: v.cnt, amt: v.amt, color: statusColor[key] || statusColor.other };
        });

        // Add Paid Out from transaction_status group if supplied
        if (paidOut > 0) {
          let paidAmt = 0;
          try {
            paidAmt = (Array.isArray(byStatus) ? byStatus : [])
              .filter(r => r && typeof r.status === 'string' && /paid\s*out|paid_out|payout|paid/i.test(r.status))
              .reduce((s, r) => s + (parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0), 0);
          } catch (e) {
            paidAmt = 0;
          }
          rows.push({ name: 'Paid Out', cnt: paidOut, amt: paidAmt, color: statusColor.paid_out });
        }
      } else {
        // Fallback: preserve original 3-row display
        rows = [
          { name: 'Pending', cnt: pending, amt: 0, color: statusColor.pending },
          { name: 'Approved', cnt: approved, amt: 0, color: statusColor.approved },
          { name: 'Paid Out', cnt: paidOut, amt: 0, color: statusColor.paid_out },
        ];
      }

      rows = rows.filter(r => (parseInt(r.cnt, 10) || 0) > 0);

      const sum = rows.reduce((s, r) => s + (parseInt(r.cnt, 10) || 0), 0);
      if (!sum) {
        // If we have a total but no categorized rows, show it as Other instead of hiding
        if (totalFromMeta > 0) {
          rows = [{ name: 'Other', cnt: totalFromMeta, amt: 0, color: statusColor.other }];
        } else {
          $row.hide();
          $body.empty();
          $ttl.text('');
          return;
        }
      }

      const total = totalFromMeta > 0 ? totalFromMeta : rows.reduce((s, r) => s + (parseInt(r.cnt, 10) || 0), 0);
      if (total > sum) {
        rows.push({ name: 'Other', cnt: (total - sum), amt: 0, color: statusColor.other });
      }

      $row.show();

      const shownTotal = totalFromMeta > 0 ? totalFromMeta : rows.reduce((s, r) => s + (parseInt(r.cnt, 10) || 0), 0);
      $ttl.text(`${Number(shownTotal).toLocaleString()} cashpickups`);

      const denom = shownTotal > 0 ? shownTotal : 1;
      const html = rows
        .filter(r => (parseInt(r.cnt, 10) || 0) > 0)
        .sort((a, b) => (parseInt(b.cnt, 10) || 0) - (parseInt(a.cnt, 10) || 0))
        .map((r) => {
        const pct = Math.round(((parseInt(r.cnt, 10) || 0) / denom) * 100);
        const safeName = $('<div>').text(r.name).html();
        const amt = parseFloat(r.amt || 0) || 0;
        return `
          <div class="role-dist-item">
            <div class="role-dist-name" title="${safeName}">${safeName}</div>
            <div class="role-dist-right">
              <div class="role-dist-meta">
                <span>${Number(r.cnt).toLocaleString()}${amt ? ` | ${fmtAmt(amt)}` : ''}</span>
                <span>${pct}%</span>
              </div>
              <div class="role-dist-progress">
                <div class="role-dist-bar" style="width:${pct}%;background:${r.color};"></div>
              </div>
            </div>
          </div>
        `;
      }).join('');

      $body.html(html);
    } catch (e) {
    }
  }

  function renderAgencyBankingDistribution(out) {
    try {
      const $row = $('#agencyDistRow');
      const $ttl = $('#agencyDistTotal');
      const $netTyp = $('#agencyDistNetTypeBody');
      const $usr = $('#agencyDistUserBody');

      const ov = out.agencybankings?.Overview || {};
      const totalTx = parseInt(ov.total_transactions, 10) || 0;
      const totalAmt = parseFloat(ov.total_amount ?? 0) || 0;
      const byNet = out.agencybankings?.By_Network || [];
      const byType = out.agencybankings?.By_Type || [];
      const byNetType = out.agencybankings?.By_Network_Type || [];
      const byUser = out.agencybankings?.By_Created_By || [];
      const byUserBreakdown = out.agencybankings?.By_Created_By_Breakdown || [];

      const anyData = (Array.isArray(byNet) && byNet.length) || (Array.isArray(byType) && byType.length) || (Array.isArray(byUser) && byUser.length);
      if (!anyData) {
        $row.hide();
        $ttl.text('');
        $netTyp.empty();
        $usr.empty();
        return;
      }

      $row.show();
      if (totalAmt > 0 && totalTx > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}  |  ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $ttl.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $ttl.text('');
      }

      function pickTop(rows, n) {
        rows = Array.isArray(rows) ? rows.slice() : [];
        rows.sort(function(a, b){
          const av = parseFloat(a?.total_amount ?? a?.amount ?? a?.sum ?? a?.value ?? a?.__amount ?? 0) || 0;
          const bv = parseFloat(b?.total_amount ?? b?.amount ?? b?.sum ?? b?.value ?? b?.__amount ?? 0) || 0;
          return bv - av;
        });
        const top = rows.slice(0, n);
        const rest = rows.slice(n);
        const restSum = rest.reduce(function(s, r){
          return s + (parseFloat(r?.total_amount ?? r?.amount ?? r?.sum ?? r?.value ?? 0) || 0);
        }, 0);
        if (restSum > 0) {
          top.push({ __label: 'Others', __amount: restSum, __others: true, __members: rest });
        }
        return top;
      }

      (function renderNetworkGrouped(){
        try {
          const palette = ['#f59e0b','#22c55e','#0ea5e9','#a855f7','#ef4444','#14b8a6','#6366f1','#f97316'];
          const cleanNet = (Array.isArray(byNet) ? byNet : []).map(function(r){
            return {
              network: String(r?.network ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            };
          }).filter(function(r){ return r.amount > 0; });
          cleanNet.sort(function(a, b){ return (b.amount || 0) - (a.amount || 0); });
          const topN = cleanNet.slice(0, 6);
          const restN = cleanNet.slice(6);
          const restAmt = restN.reduce(function(s, r){ return s + (parseFloat(r.amount || 0) || 0); }, 0);
          if (restAmt > 0) topN.push({ network: 'Others', amount: restAmt, __others: true });

          const byNetwork = {};
          (Array.isArray(byNetType) ? byNetType : []).forEach(function(r){
            const net = String(r?.network ?? '').trim() || 'Unknown';
            if (!byNetwork[net]) byNetwork[net] = [];
            byNetwork[net].push({
              type: String(r?.type ?? r?.transaction_type ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            });
          });

          const html = topN.map(function(n, idx){
            const net = String(n.network || '').trim() || 'Unknown';
            const total = parseFloat(n.amount || 0) || 0;
            const color = palette[idx % palette.length];

            const lines = (byNetwork[net] || []).slice().sort(function(a, b){
              return (parseFloat(b.amount || 0) || 0) - (parseFloat(a.amount || 0) || 0);
            }).filter(function(r){ return (parseFloat(r.amount || 0) || 0) > 0; });

            const subHtml = lines.map(function(r){
              const typ = String(r.type || '').trim() || 'Unknown';
              const amt = parseFloat(r.amount || 0) || 0;
              const pct = total > 0 ? Math.round((amt / total) * 100) : 0;
              const safeLabel = $('<div>').text(typ).html();
              return `
                <div class="ab-user-line">
                  <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${pct}%;background:${color};"></div></div></div>
                  <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                </div>
              `;
            }).join('');

            const safeNet = $('<div>').text(net).html();
            return `
              <div class="ab-user-group" data-net="${safeNet}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeNet}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeNet}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()}</div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $netTyp.html(html);

          $netTyp.off('click.agNetAcc keydown.agNetAcc', '.ab-user-title');
          $netTyp.on('click.agNetAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $netTyp.on('keydown.agNetAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $netTyp.empty();
        }
      })();
      (function renderCreatedByGrouped(){
        try {
          function normalizeUsers(rows){
            const map = {};
            const others = [];
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              if(r && r.__others){
                others.push(r);
                return;
              }
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              if(!map[uid]){
                map[uid] = {
                  created_by: uid,
                  full_name: String(r?.full_name ?? '').trim(),
                  total_amount: 0,
                  total_count: 0,
                };
              }
              const amt = parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0;
              const cnt = parseInt(r?.total_count ?? r?.total_transactions ?? r?.customers ?? r?.cnt ?? 0, 10) || 0;
              map[uid].total_amount += amt;
              map[uid].total_count += cnt;
              if(!map[uid].full_name){
                map[uid].full_name = String(r?.full_name ?? '').trim();
              }
            });
            const out = Object.keys(map).map(function(k){ return map[k]; });
            return out.concat(others);
          }

          function normalizeBreakdown(rows){
            const map = {};
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              const net = String(r?.network ?? '').trim();
              const typ = String(r?.transaction_type ?? '').trim();
              const key = uid + '|' + net + '|' + typ;
              if(!map[key]){
                map[key] = {
                  created_by: uid,
                  network: net,
                  transaction_type: typ,
                  total_amount: 0,
                  total_count: 0,
                };
              }
              map[key].total_amount += (parseFloat(r?.total_amount ?? 0) || 0);
              map[key].total_count += (parseInt(r?.total_count ?? 0, 10) || 0);
            });
            return Object.keys(map).map(function(k){ return map[k]; });
          }

          const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1'];
          const cleanUsers = normalizeUsers(byUser);
          const cleanBreakdown = normalizeBreakdown(byUserBreakdown);

          const users = pickTop(cleanUsers, 5);
          const uSum = users.reduce(function(s, r){ return s + (parseFloat(r?.total_amount ?? 0) || 0); }, 0);
          const byUid = {};
          (Array.isArray(cleanBreakdown) ? cleanBreakdown : []).forEach(function(r){
            const uid = String(r?.created_by ?? '').trim();
            if(!uid) return;
            if(!byUid[uid]) byUid[uid] = [];
            byUid[uid].push(r);
          });

          const html = users.map(function(u, idx){
            const uid = String(u?.created_by ?? '').trim();
            const userName = String(u?.full_name || (uid ? ('User ' + uid) : (u?.__label || 'Unknown User'))).trim();
            const total = parseFloat(u?.total_amount ?? u?.__amount ?? 0) || 0;
            const pct = uSum > 0 ? Math.round((total / uSum) * 100) : 0;
            const color = palette[idx % palette.length];
            const lines = (byUid[uid] || []).slice().sort(function(a, b){
              return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
            }).filter(function(r){
              return (parseFloat(r?.total_amount ?? 0) || 0) > 0;
            });

            const subHtml = u?.__others
              ? (u.__members || []).map(function(member, memberIndex){
                  const memberId = String(member?.created_by ?? '').trim();
                  const memberName = String(member?.full_name || (memberId ? ('User ' + memberId) : 'Unknown User')).trim();
                  const memberTotal = parseFloat(member?.total_amount ?? 0) || 0;
                  const memberColor = palette[(idx + memberIndex + 1) % palette.length];
                  const memberLines = (byUid[memberId] || []).slice().sort(function(a, b){
                    return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
                  }).filter(function(r){ return (parseFloat(r?.total_amount ?? 0) || 0) > 0; });
                  const safeMemberName = $('<div>').text(memberName).html();
                  const details = memberLines.map(function(r){
                    const net = String(r?.network ?? '').trim();
                    const typ = String(r?.transaction_type ?? '').trim();
                    const label = (net && typ) ? `${net} / ${typ}` : (net || typ || 'Unknown');
                    const amt = parseFloat(r?.total_amount ?? 0) || 0;
                    const upct = memberTotal > 0 ? Math.round((amt / memberTotal) * 100) : 0;
                    const safeLabel = $('<div>').text(label).html();
                    return `
                      <div class="ab-user-line" style="padding-left:1.25rem;">
                        <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${memberColor};"></div></div></div>
                        <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                      </div>
                    `;
                  }).join('');
                  const memberPct = total > 0 ? Math.round((memberTotal / total) * 100) : 0;
                  return `
                    <div class="ab-user-group ab-user-member">
                      <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                        <div class="ab-user-name" title="${safeMemberName}"><span style="display:inline-block;width:8px;height:8px;border-radius:999px;background:${memberColor};margin-right:6px;"></span>${safeMemberName}<span class="ab-user-chevron">›</span></div>
                        <div class="ab-user-total">₵${Number(memberTotal).toLocaleString()} <span style="opacity:0.85;">(${memberPct}%)</span></div>
                      </div>
                      <div class="ab-user-sub">${details}</div>
                    </div>
                  `;
                }).join('')
              : lines.map(function(r){
                  const net = String(r?.network ?? '').trim();
                  const typ = String(r?.transaction_type ?? '').trim();
                  const label = (net && typ) ? `${net} / ${typ}` : (net || typ || '');
                  const amt = parseFloat(r?.total_amount ?? 0) || 0;
                  const upct = total > 0 ? Math.round((amt / total) * 100) : 0;
                  const safeLabel = $('<div>').text(label).html();
                  return `
                    <div class="ab-user-line">
                      <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${color};"></div></div></div>
                      <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                    </div>
                  `;
                }).join('');

            const safeUser = $('<div>').text(userName).html();
            return `
              <div class="ab-user-group" data-uid="${uid}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeUser}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeUser}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()} <span style="opacity:0.85;">(${pct}%)</span></div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $usr.html(html);

          $usr.off('click.agAcc keydown.agAcc', '.ab-user-title');
          $usr.on('click.agAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $usr.on('keydown.agAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $usr.empty();
        }
      })();
    } catch (e) {
      try { $('#airtimeDistRow').hide(); } catch (e2) {}
    }
  }

  function renderMomoRemitsDistribution(out) {
    try {
      const $row = $('#momoDistRow');
      const $ttl = $('#momoDistTotal');
      const $netTyp = $('#momoDistNetTypeBody');
      const $usr = $('#momoDistUserBody');

      const ov = out.momoremits?.Overview || {};
      const totalTx = parseInt(ov.customers_served ?? 0, 10) || 0;
      const totalAmt = parseFloat(ov.total_amount ?? 0) || 0;
      const byNet = out.momoremits?.By_Network || [];
      const byType = out.momoremits?.By_Type || [];
      const byNetType = out.momoremits?.By_Network_Type || [];
      const byUser = out.momoremits?.By_Created_By || [];
      const byUserBreakdown = out.momoremits?.By_Created_By_Breakdown || [];

      const anyData = (Array.isArray(byNet) && byNet.length) || (Array.isArray(byType) && byType.length) || (Array.isArray(byUser) && byUser.length);
      if (!anyData) {
        $row.hide();
        $ttl.text('');
        $netTyp.empty();
        $usr.empty();
        return;
      }

      $row.show();
      if (totalAmt > 0 && totalTx > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}  |  ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $ttl.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $ttl.text('');
      }

      function pickTop(rows, n) {
        rows = Array.isArray(rows) ? rows.slice() : [];
        rows.sort(function(a, b){
          const av = parseFloat(a?.total_amount ?? a?.amount ?? a?.sum ?? a?.value ?? a?.__amount ?? 0) || 0;
          const bv = parseFloat(b?.total_amount ?? b?.amount ?? b?.sum ?? b?.value ?? b?.__amount ?? 0) || 0;
          return bv - av;
        });
        const top = rows.slice(0, n);
        const rest = rows.slice(n);
        const restSum = rest.reduce(function(s, r){
          return s + (parseFloat(r?.total_amount ?? r?.amount ?? r?.sum ?? r?.value ?? 0) || 0);
        }, 0);
        if (restSum > 0) {
          top.push({ __label: 'Others', __amount: restSum, __others: true, __members: rest });
        }
        return top;
      }

      (function renderNetworkGrouped(){
        try {
          const palette = ['#f59e0b','#22c55e','#0ea5e9','#a855f7','#ef4444','#14b8a6','#6366f1','#f97316'];
          const cleanNet = (Array.isArray(byNet) ? byNet : []).map(function(r){
            return {
              network: String(r?.network ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            };
          }).filter(function(r){ return r.amount > 0; });
          cleanNet.sort(function(a, b){ return (b.amount || 0) - (a.amount || 0); });
          const topN = cleanNet.slice(0, 6);
          const restN = cleanNet.slice(6);
          const restAmt = restN.reduce(function(s, r){ return s + (parseFloat(r.amount || 0) || 0); }, 0);
          if (restAmt > 0) topN.push({ network: 'Others', amount: restAmt, __others: true });

          const byNetwork = {};
          (Array.isArray(byNetType) ? byNetType : []).forEach(function(r){
            const net = String(r?.network ?? '').trim() || 'Unknown';
            if (!byNetwork[net]) byNetwork[net] = [];
            byNetwork[net].push({
              type: String(r?.type ?? r?.transaction_type ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            });
          });

          const html = topN.map(function(n, idx){
            const net = String(n.network || '').trim() || 'Unknown';
            const total = parseFloat(n.amount || 0) || 0;
            const color = palette[idx % palette.length];

            const lines = (byNetwork[net] || []).slice().sort(function(a, b){
              return (parseFloat(b.amount || 0) || 0) - (parseFloat(a.amount || 0) || 0);
            }).filter(function(r){ return (parseFloat(r.amount || 0) || 0) > 0; });

            const subHtml = lines.map(function(r){
              const typ = String(r.type || '').trim() || 'Unknown';
              const amt = parseFloat(r.amount || 0) || 0;
              const pct = total > 0 ? Math.round((amt / total) * 100) : 0;
              const safeLabel = $('<div>').text(typ).html();
              return `
                <div class="ab-user-line">
                  <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${pct}%;background:${color};"></div></div></div>
                  <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                </div>
              `;
            }).join('');

            const safeNet = $('<div>').text(net).html();
            return `
              <div class="ab-user-group" data-net="${safeNet}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeNet}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeNet}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()}</div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $netTyp.html(html);

          $netTyp.off('click.momoNetAcc keydown.momoNetAcc', '.ab-user-title');
          $netTyp.on('click.momoNetAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $netTyp.on('keydown.momoNetAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $netTyp.empty();
        }
      })();

      (function renderCreatedByGrouped(){
        try {
          function normalizeUsers(rows){
            const map = {};
            const others = [];
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              if(r && r.__others){
                others.push(r);
                return;
              }
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              if(!map[uid]){
                map[uid] = {
                  created_by: uid,
                  full_name: String(r?.full_name ?? '').trim(),
                  total_amount: 0,
                  total_count: 0,
                };
              }
              const amt = parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0;
              const cnt = parseInt(r?.total_count ?? r?.total_transactions ?? r?.customers ?? r?.cnt ?? 0, 10) || 0;
              map[uid].total_amount += amt;
              map[uid].total_count += cnt;
              if(!map[uid].full_name){
                map[uid].full_name = String(r?.full_name ?? '').trim();
              }
            });
            const out = Object.keys(map).map(function(k){ return map[k]; });
            return out.concat(others);
          }

          function normalizeBreakdown(rows){
            const map = {};
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              const net = String(r?.network ?? '').trim();
              const typ = String(r?.transaction_type ?? '').trim();
              const key = uid + '|' + net + '|' + typ;
              if(!map[key]){
                map[key] = {
                  created_by: uid,
                  network: net,
                  transaction_type: typ,
                  total_amount: 0,
                  total_count: 0,
                };
              }
              map[key].total_amount += (parseFloat(r?.total_amount ?? 0) || 0);
              map[key].total_count += (parseInt(r?.total_count ?? 0, 10) || 0);
            });
            return Object.keys(map).map(function(k){ return map[k]; });
          }

          const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1'];
          const cleanUsers = normalizeUsers(byUser);
          const cleanBreakdown = normalizeBreakdown(byUserBreakdown);

          const users = pickTop(cleanUsers, 5);
          const uSum = users.reduce(function(s, r){ return s + (parseFloat(r?.total_amount ?? 0) || 0); }, 0);
          const byUid = {};
          (Array.isArray(cleanBreakdown) ? cleanBreakdown : []).forEach(function(r){
            const uid = String(r?.created_by ?? '').trim();
            if(!uid) return;
            if(!byUid[uid]) byUid[uid] = [];
            byUid[uid].push(r);
          });

          const html = users.map(function(u, idx){
            const uid = String(u?.created_by ?? '').trim();
            const userName = String(u?.full_name || (uid ? ('User ' + uid) : (u?.__label || 'Unknown User'))).trim();
            const total = parseFloat(u?.total_amount ?? u?.__amount ?? 0) || 0;
            const pct = uSum > 0 ? Math.round((total / uSum) * 100) : 0;
            const color = palette[idx % palette.length];
            const lines = (byUid[uid] || []).slice().sort(function(a, b){
              return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
            }).filter(function(r){
              return (parseFloat(r?.total_amount ?? 0) || 0) > 0;
            });

            const subHtml = u?.__others
              ? (u.__members || []).map(function(member, memberIndex){
                  const memberId = String(member?.created_by ?? '').trim();
                  const memberName = String(member?.full_name || (memberId ? ('User ' + memberId) : 'Unknown User')).trim();
                  const memberTotal = parseFloat(member?.total_amount ?? 0) || 0;
                  const memberColor = palette[(idx + memberIndex + 1) % palette.length];
                  const memberLines = (byUid[memberId] || []).slice().sort(function(a, b){
                    return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
                  }).filter(function(r){ return (parseFloat(r?.total_amount ?? 0) || 0) > 0; });
                  const safeMemberName = $('<div>').text(memberName).html();
                  const details = memberLines.map(function(r){
                    const net = String(r?.network ?? '').trim();
                    const typ = String(r?.transaction_type ?? '').trim();
                    const label = (net && typ) ? `${net} / ${typ}` : (net || typ || 'Unknown');
                    const amt = parseFloat(r?.total_amount ?? 0) || 0;
                    const upct = memberTotal > 0 ? Math.round((amt / memberTotal) * 100) : 0;
                    const safeLabel = $('<div>').text(label).html();
                    return `
                      <div class="ab-user-line" style="padding-left:1.25rem;">
                        <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${memberColor};"></div></div></div>
                        <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                      </div>
                    `;
                  }).join('');
                  const memberPct = total > 0 ? Math.round((memberTotal / total) * 100) : 0;
                  return `
                    <div class="ab-user-group ab-user-member">
                      <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                        <div class="ab-user-name" title="${safeMemberName}"><span style="display:inline-block;width:8px;height:8px;border-radius:999px;background:${memberColor};margin-right:6px;"></span>${safeMemberName}<span class="ab-user-chevron">›</span></div>
                        <div class="ab-user-total">₵${Number(memberTotal).toLocaleString()} <span style="opacity:0.85;">(${memberPct}%)</span></div>
                      </div>
                      <div class="ab-user-sub">${details}</div>
                    </div>
                  `;
                }).join('')
              : lines.map(function(r){
                  const net = String(r?.network ?? '').trim();
                  const typ = String(r?.transaction_type ?? '').trim();
                  const label = (net && typ) ? `${net} / ${typ}` : (net || typ || '');
                  const amt = parseFloat(r?.total_amount ?? 0) || 0;
                  const upct = total > 0 ? Math.round((amt / total) * 100) : 0;
                  const safeLabel = $('<div>').text(label).html();
                  return `
                    <div class="ab-user-line">
                      <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${color};"></div></div></div>
                      <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                    </div>
                  `;
                }).join('');

            const safeUser = $('<div>').text(userName).html();
            return `
              <div class="ab-user-group" data-uid="${uid}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeUser}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeUser}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()} <span style="opacity:0.85;">(${pct}%)</span></div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $usr.html(html);

          $usr.off('click.momoAcc keydown.momoAcc', '.ab-user-title');
          $usr.on('click.momoAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $usr.on('keydown.momoAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $usr.empty();
        }
      })();
    } catch (e) {
      try { $('#momoDistRow').hide(); } catch (e2) {}
    }
  }

  function renderAirtimebundleDistribution(out) {
    try {
      const $row = $('#airtimeDistRow');
      const $ttl = $('#airtimeDistTotal');
      const $netTyp = $('#airtimeDistNetTypeBody');
      const $usr = $('#airtimeDistUserBody');

      const ov = out.airtimebundles?.Overview || {};
      const totalTx = parseInt(ov.total_transactions ?? 0, 10) || 0;
      const totalAmt = parseFloat(ov.total_amount ?? 0) || 0;
      const byNet = out.airtimebundles?.By_Network || [];
      const byType = out.airtimebundles?.By_Type || [];
      const byNetType = out.airtimebundles?.By_Network_Type || [];
      const byUser = out.airtimebundles?.By_Created_By || [];
      const byUserBreakdown = out.airtimebundles?.By_Created_By_Breakdown || [];

      const anyData = (Array.isArray(byNet) && byNet.length) || (Array.isArray(byType) && byType.length) || (Array.isArray(byUser) && byUser.length);
      if (!anyData) {
        $row.hide();
        $ttl.text('');
        $netTyp.empty();
        $usr.empty();
        return;
      }

      $row.show();
      if (totalAmt > 0 && totalTx > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}  |  ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $ttl.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $ttl.text('');
      }

      function pickTop(rows, n) {
        rows = Array.isArray(rows) ? rows.slice() : [];
        rows.sort(function(a, b){
          const av = parseFloat(a?.total_amount ?? a?.amount ?? a?.sum ?? a?.value ?? a?.__amount ?? 0) || 0;
          const bv = parseFloat(b?.total_amount ?? b?.amount ?? b?.sum ?? b?.value ?? b?.__amount ?? 0) || 0;
          return bv - av;
        });
        const top = rows.slice(0, n);
        const rest = rows.slice(n);
        const restSum = rest.reduce(function(s, r){
          return s + (parseFloat(r?.total_amount ?? r?.amount ?? r?.sum ?? r?.value ?? 0) || 0);
        }, 0);
        if (restSum > 0) {
          top.push({ __label: 'Others', __amount: restSum, __others: true, __members: rest });
        }
        return top;
      }

      (function renderNetworkGrouped(){
        try {
          const palette = ['#f59e0b','#22c55e','#0ea5e9','#a855f7','#ef4444','#14b8a6','#6366f1','#f97316'];
          const cleanNet = (Array.isArray(byNet) ? byNet : []).map(function(r){
            return {
              network: String(r?.network ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            };
          }).filter(function(r){ return r.amount > 0; });
          cleanNet.sort(function(a, b){ return (b.amount || 0) - (a.amount || 0); });
          const topN = cleanNet.slice(0, 6);
          const restN = cleanNet.slice(6);
          const restAmt = restN.reduce(function(s, r){ return s + (parseFloat(r.amount || 0) || 0); }, 0);
          if (restAmt > 0) topN.push({ network: 'Others', amount: restAmt, __others: true });

          const byNetwork = {};
          (Array.isArray(byNetType) ? byNetType : []).forEach(function(r){
            const net = String(r?.network ?? '').trim() || 'Unknown';
            if (!byNetwork[net]) byNetwork[net] = [];
            byNetwork[net].push({
              type: String(r?.type ?? r?.transaction_type ?? '').trim() || 'Unknown',
              amount: parseFloat(r?.amount ?? r?.total_amount ?? 0) || 0,
            });
          });

          const html = topN.map(function(n, idx){
            const net = String(n.network || '').trim() || 'Unknown';
            const total = parseFloat(n.amount || 0) || 0;
            const color = palette[idx % palette.length];

            const lines = (byNetwork[net] || []).slice().sort(function(a, b){
              return (parseFloat(b.amount || 0) || 0) - (parseFloat(a.amount || 0) || 0);
            }).filter(function(r){ return (parseFloat(r.amount || 0) || 0) > 0; });

            const subHtml = lines.map(function(r){
              const typ = String(r.type || '').trim() || 'Unknown';
              const amt = parseFloat(r.amount || 0) || 0;
              const pct = total > 0 ? Math.round((amt / total) * 100) : 0;
              const safeLabel = $('<div>').text(typ).html();
              return `
                <div class="ab-user-line">
                  <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${pct}%;background:${color};"></div></div></div>
                  <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                </div>
              `;
            }).join('');

            const safeNet = $('<div>').text(net).html();
            return `
              <div class="ab-user-group" data-net="${safeNet}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeNet}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeNet}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()}</div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $netTyp.html(html);

          $netTyp.off('click.airNetAcc keydown.airNetAcc', '.ab-user-title');
          $netTyp.on('click.airNetAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $netTyp.on('keydown.airNetAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $netTyp.empty();
        }
      })();

      (function renderCreatedByGrouped(){
        try {
          function normalizeUsers(rows){
            const map = {};
            const others = [];
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              if(r && r.__others){
                others.push(r);
                return;
              }
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              if(!map[uid]){
                map[uid] = {
                  created_by: uid,
                  full_name: String(r?.full_name ?? '').trim(),
                  total_amount: 0,
                  total_count: 0,
                };
              }
              const amt = parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0;
              const cnt = parseInt(r?.total_count ?? r?.total_transactions ?? r?.customers ?? r?.cnt ?? 0, 10) || 0;
              map[uid].total_amount += amt;
              map[uid].total_count += cnt;
              if(!map[uid].full_name){
                map[uid].full_name = String(r?.full_name ?? '').trim();
              }
            });
            const out = Object.keys(map).map(function(k){ return map[k]; });
            return out.concat(others);
          }

          function normalizeBreakdown(rows){
            const map = {};
            (Array.isArray(rows) ? rows : []).forEach(function(r){
              const uid = String(r?.created_by ?? '').trim();
              if(!uid) return;
              const net = String(r?.network ?? '').trim();
              const typ = String(r?.transaction_type ?? '').trim();
              const key = uid + '|' + net + '|' + typ;
              if(!map[key]){
                map[key] = {
                  created_by: uid,
                  network: net,
                  transaction_type: typ,
                  total_amount: 0,
                  total_count: 0,
                };
              }
              map[key].total_amount += (parseFloat(r?.total_amount ?? 0) || 0);
              map[key].total_count += (parseInt(r?.total_count ?? 0, 10) || 0);
            });
            return Object.keys(map).map(function(k){ return map[k]; });
          }

          const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1'];
          const cleanUsers = normalizeUsers(byUser);
          const cleanBreakdown = normalizeBreakdown(byUserBreakdown);

          const users = pickTop(cleanUsers, 5);
          const uSum = users.reduce(function(s, r){ return s + (parseFloat(r?.total_amount ?? 0) || 0); }, 0);
          const byUid = {};
          (Array.isArray(cleanBreakdown) ? cleanBreakdown : []).forEach(function(r){
            const uid = String(r?.created_by ?? '').trim();
            if(!uid) return;
            if(!byUid[uid]) byUid[uid] = [];
            byUid[uid].push(r);
          });

          const html = users.map(function(u, idx){
            const uid = String(u?.created_by ?? '').trim();
            const userName = String(u?.full_name || (uid ? ('User ' + uid) : (u?.__label || 'Unknown User'))).trim();
            const total = parseFloat(u?.total_amount ?? u?.__amount ?? 0) || 0;
            const pct = uSum > 0 ? Math.round((total / uSum) * 100) : 0;
            const color = palette[idx % palette.length];
            const lines = (byUid[uid] || []).slice().sort(function(a, b){
              return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
            }).filter(function(r){
              return (parseFloat(r?.total_amount ?? 0) || 0) > 0;
            });

            const subHtml = u?.__others
              ? (u.__members || []).map(function(member, memberIndex){
                  const memberId = String(member?.created_by ?? '').trim();
                  const memberName = String(member?.full_name || (memberId ? ('User ' + memberId) : 'Unknown User')).trim();
                  const memberTotal = parseFloat(member?.total_amount ?? 0) || 0;
                  const memberColor = palette[(idx + memberIndex + 1) % palette.length];
                  const memberLines = (byUid[memberId] || []).slice().sort(function(a, b){
                    return (parseFloat(b?.total_amount ?? 0) || 0) - (parseFloat(a?.total_amount ?? 0) || 0);
                  }).filter(function(r){ return (parseFloat(r?.total_amount ?? 0) || 0) > 0; });
                  const safeMemberName = $('<div>').text(memberName).html();
                  const details = memberLines.map(function(r){
                    const net = String(r?.network ?? '').trim();
                    const typ = String(r?.transaction_type ?? '').trim();
                    const label = (net && typ) ? `${net} / ${typ}` : (net || typ || 'Unknown');
                    const amt = parseFloat(r?.total_amount ?? 0) || 0;
                    const upct = memberTotal > 0 ? Math.round((amt / memberTotal) * 100) : 0;
                    const safeLabel = $('<div>').text(label).html();
                    return `
                      <div class="ab-user-line" style="padding-left:1.25rem;">
                        <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${memberColor};"></div></div></div>
                        <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                      </div>
                    `;
                  }).join('');
                  const memberPct = total > 0 ? Math.round((memberTotal / total) * 100) : 0;
                  return `
                    <div class="ab-user-group ab-user-member">
                      <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                        <div class="ab-user-name" title="${safeMemberName}"><span style="display:inline-block;width:8px;height:8px;border-radius:999px;background:${memberColor};margin-right:6px;"></span>${safeMemberName}<span class="ab-user-chevron">›</span></div>
                        <div class="ab-user-total">₵${Number(memberTotal).toLocaleString()} <span style="opacity:0.85;">(${memberPct}%)</span></div>
                      </div>
                      <div class="ab-user-sub">${details}</div>
                    </div>
                  `;
                }).join('')
              : lines.map(function(r){
                  const net = String(r?.network ?? '').trim();
                  const typ = String(r?.transaction_type ?? '').trim();
                  const label = (net && typ) ? `${net} / ${typ}` : (net || typ || '');
                  const amt = parseFloat(r?.total_amount ?? 0) || 0;
                  const upct = total > 0 ? Math.round((amt / total) * 100) : 0;
                  const safeLabel = $('<div>').text(label).html();
                  return `
                    <div class="ab-user-line">
                      <div class="ab-user-label">${safeLabel}<div class="ab-user-mini"><div style="width:${upct}%;background:${color};"></div></div></div>
                      <div class="ab-user-amt">₵${Number(amt).toLocaleString()}</div>
                    </div>
                  `;
                }).join('');

            const safeUser = $('<div>').text(userName).html();
            return `
              <div class="ab-user-group" data-uid="${uid}">
                <div class="ab-user-title" role="button" tabindex="0" aria-expanded="false">
                  <div class="ab-user-name" title="${safeUser}"><span style="display:inline-block;width:10px;height:10px;border-radius:999px;background:${color};margin-right:8px;vertical-align:middle;"></span>${safeUser}<span class="ab-user-chevron">›</span></div>
                  <div class="ab-user-total">₵${Number(total).toLocaleString()} <span style="opacity:0.85;">(${pct}%)</span></div>
                </div>
                <div class="ab-user-sub">${subHtml}</div>
              </div>
            `;
          }).join('');

          $usr.html(html);

          $usr.off('click.airAcc keydown.airAcc', '.ab-user-title');
          $usr.on('click.airAcc', '.ab-user-title', function(){
            const $grp = $(this).closest('.ab-user-group');
            const open = $grp.hasClass('is-open');
            $grp.toggleClass('is-open', !open);
            $(this).attr('aria-expanded', String(!open));
          });
          $usr.on('keydown.airAcc', '.ab-user-title', function(e){
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              $(this).trigger('click');
            }
          });
        } catch (e) {
          $usr.empty();
        }
      })();
    } catch (e) {
      try { $('#airtimeDistRow').hide(); } catch (e2) {}
    }
  }

  function renderPaymentServicesByCategory(out) {
    try {
      const $card = $('#svcCatCard');
      const $row = $('#opsInsightsRow');
      const $ttl = $('#svcCatTotal');
      const $body = $('#svcCatBody');

      const sum = out.payment_services?.Summary || {};
      const rows = out.payment_services?.By_Category || [];
      const totalAmt = parseFloat(sum.total_amount ?? 0) || 0;
      const totalTx = parseInt(sum.total_customers ?? 0, 10) || 0;

      if (!Array.isArray(rows) || !rows.length) {
        $card.hide();
        $ttl.text('');
        $body.empty();
        return;
      }

      $row.show();
      $card.show();
      if (totalAmt > 0 && totalTx > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}  |  ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $ttl.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $ttl.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $ttl.text('');
      }

      const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1','#f97316'];
      const clean = rows.map(r => ({
        label: String(r?.category ?? '').trim() || 'Unspecified',
        amount: parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0,
      })).filter(r => r.amount > 0);
      clean.sort((a, b) => (b.amount || 0) - (a.amount || 0));
      const top = clean.slice(0, 6);
      const rest = clean.slice(6);
      const restSum = rest.reduce((s, r) => s + (parseFloat(r.amount || 0) || 0), 0);
      if (restSum > 0) top.push({ label: 'Others', amount: restSum });
      const denom = top.reduce((s, r) => s + (parseFloat(r.amount || 0) || 0), 0) || 1;

      const html = top.map((r, idx) => {
        const pct = Math.round((r.amount / denom) * 100);
        const safe = $('<div>').text(r.label).html();
        const color = palette[idx % palette.length];
        return `
          <div class="mb-2">
            <div class="d-flex align-items-center justify-content-between" style="gap:8px;">
              <div style="min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${safe}">${safe}</div>
              <div style="white-space:nowrap;opacity:0.85;">₵${Number(r.amount).toLocaleString()} (${pct}%)</div>
            </div>
            <div class="progress" style="height:8px;">
              <div class="progress-bar" role="progressbar" style="width:${pct}%;background:${color};" aria-valuenow="${pct}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        `;
      }).join('');
      $body.html(html);
    } catch (e) {
      try { $('#svcCatCard').hide(); } catch (e2) {}
    }
  }

  function renderAirtimebundleTransactions(out) {
    try {
      const $card = $('#airtimebundleCard');
      const $row = $('#volumeInsightsRow');
      const $meta = $('#airtimebundleMeta');

      const overview = out.airtimebundles?.Overview || {};
      const rows = out.airtimebundles?.By_Status || [];
      const totalAmt = parseFloat(overview.total_amount ?? 0) || 0;
      const totalTx = parseInt(overview.total_transactions ?? 0, 10) || 0;

      if (!Array.isArray(rows) || !rows.length) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartAirtimebundleTx');
        return;
      }
      const clean = rows.map(r => ({
        label: String(r?.status ?? '').trim() || 'Unknown',
        count: parseInt(r?.customers ?? r?.count ?? 0, 10) || 0,
      })).filter(r => r.count > 0);
      clean.sort((a, b) => (b.count || 0) - (a.count || 0));
      const top = clean.slice(0, 8);
      const labels = top.map(r => r.label);
      const data = top.map(r => r.count);
      if (!data.length) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartAirtimebundleTx');
        return;
      }
      $row.show();
      $card.show();
      if (totalAmt > 0 && totalTx > 0) {
        $meta.text(`₵${Number(totalAmt).toLocaleString()} | ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $meta.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $meta.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $meta.text('');
      }

      renderBar('chartAirtimebundleTx', labels, data, 'Count');
    } catch (e) {
      try { $('#airtimebundleCard').hide(); destroyAndClear('chartAirtimebundleTx'); } catch (e2) {}
    }
  }

  function renderTicketsStatus(out) {
    try {
      const $card = $('#ticketsStatusCard');
      const $row = $('#opsInsightsRow');
      const $meta = $('#ticketsMeta');
      const rows = out.tickets?.By_Status || [];
      const avg = parseFloat(out.tickets?.AvgResolutionTime ?? 0) || 0;

      if (!Array.isArray(rows) || !rows.length) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartTicketsStatus');
        return;
      }

      const labels = [];
      const data = [];
      rows.forEach(r => {
        const lbl = String(r?.status ?? '').trim() || 'Unknown';
        const cnt = parseInt(r?.count ?? 0, 10) || 0;
        if (!cnt) return;
        labels.push(lbl);
        data.push(cnt);
      });
      if (!data.length) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartTicketsStatus');
        return;
      }

      $row.show();
      $card.show();
      const total = data.reduce((s, v) => s + (parseInt(v, 10) || 0), 0);
      $meta.text(`${Number(total).toLocaleString()} tickets${avg > 0 ? ` | ${avg}h avg` : ''}`);
      renderPie('chartTicketsStatus', labels, data);
    } catch (e) {
      try { $('#ticketsStatusCard').hide(); destroyAndClear('chartTicketsStatus'); } catch (e2) {}
    }
  }

  function renderTransactionsByType(out) {
    try {
      const $card = $('#transactionsTypeCard');
      const $row = $('#volumeInsightsRow');
      const rows = out.transactions?.By_Type || [];
      if (!Array.isArray(rows) || !rows.length) {
        $card.hide();
        destroyAndClear('chartTransactionsByType');
        return;
      }
      const clean = rows.map(r => ({
        label: String(r?.transaction_type ?? '').trim() || 'Unknown',
        count: parseInt(r?.count ?? 0, 10) || 0,
      })).filter(r => r.count > 0);
      clean.sort((a, b) => (b.count || 0) - (a.count || 0));
      const top = clean.slice(0, 8);
      const labels = top.map(r => r.label);
      const data = top.map(r => r.count);
      if (!data.length) {
        $card.hide();
        destroyAndClear('chartTransactionsByType');
        return;
      }
      $row.show();
      $card.show();
      renderBar('chartTransactionsByType', labels, data, 'Count');
    } catch (e) {
      try { $('#transactionsTypeCard').hide(); destroyAndClear('chartTransactionsByType'); } catch (e2) {}
    }
  }

  function renderEzwichInsights(out) {
    try {
      const $card = $('#ezwichInsightsCard');
      const $row = $('#volumeInsightsRow');
      const $meta = $('#ezwichMeta');

      const sum = out.ezwichs?.Overview || {};
      const byStatus = out.ezwichs?.By_Status || [];
      const trend = out.ezwichs?.By_Date || [];

      const totalAmt = parseFloat(sum.total_amount ?? 0) || 0;
      const totalTx = parseInt(sum.total_customers ?? 0, 10) || 0;

      const sLabels = [];
      const sData = [];
      (Array.isArray(byStatus) ? byStatus : []).forEach(r => {
        const lbl = String(r?.status ?? '').trim() || 'Unknown';
        const cnt = parseInt(r?.customers ?? r?.total_customers ?? 0, 10) || 0;
        if (!cnt) return;
        sLabels.push(lbl);
        sData.push(cnt);
      });

      const tLabels = [];
      const tData = [];
      (Array.isArray(trend) ? trend : []).forEach(r => {
        const d = String(r?.day ?? r?.date ?? '').trim();
        if (!d) return;
        tLabels.push(d);
        tData.push(parseFloat(r?.total_amount ?? r?.amount ?? 0) || 0);
      });

      const hasAny = sData.length || tData.length || totalTx || totalAmt;
      if (!hasAny) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartEzwichStatus');
        destroyAndClear('chartEzwichTrend');
        return;
      }

      $row.show();
      $card.show();
      if (totalAmt > 0 && totalTx > 0) {
        $meta.text(`₵${Number(totalAmt).toLocaleString()}  |  ${Number(totalTx).toLocaleString()} txns`);
      } else if (totalAmt > 0) {
        $meta.text(`₵${Number(totalAmt).toLocaleString()}`);
      } else if (totalTx > 0) {
        $meta.text(`${Number(totalTx).toLocaleString()} txns`);
      } else {
        $meta.text('');
      }

      if (sData.length) {
        renderBar('chartEzwichStatus', sLabels, sData, 'Count');
      } else {
        destroyAndClear('chartEzwichStatus');
      }

      if (tData.length) {
        renderLine('chartEzwichTrend', tLabels, tData, 'Amount');
      } else {
        destroyAndClear('chartEzwichTrend');
      }
    } catch (e) {
      try {
        $('#ezwichInsightsCard').hide();
        destroyAndClear('chartEzwichStatus');
        destroyAndClear('chartEzwichTrend');
      } catch (e2) {}
    }
  }

  function renderRequestsHealth(out) {
    try {
      const $card = $('#requestsHealthCard');
      const $row = $('#opsInsightsRow');
      const $meta = $('#requestsMeta');
      const failureRate = parseFloat(out.requests?.FailureRate ?? 0) || 0;
      const backlog = parseInt(out.requests?.Backlog ?? 0, 10) || 0;
      const trend = out.requests?.By_Date || [];

      const labels = [];
      const failures = [];
      (Array.isArray(trend) ? trend : []).forEach(r => {
        const d = String(r?.day ?? r?.date ?? '').trim();
        if (!d) return;
        labels.push(d);
        failures.push(parseInt(r?.failures ?? 0, 10) || 0);
      });

      const hasAny = labels.length || backlog > 0 || failureRate > 0;
      if (!hasAny) {
        $card.hide();
        $meta.text('');
        destroyAndClear('chartRequestsFailures');
        return;
      }

      $row.show();
      $card.show();
      $meta.text(`${failureRate}% fail | ${Number(backlog).toLocaleString()} backlog`);
      if (labels.length) {
        renderLine('chartRequestsFailures', labels, failures, 'Failures');
      } else {
        destroyAndClear('chartRequestsFailures');
      }
    } catch (e) {
      try { $('#requestsHealthCard').hide(); destroyAndClear('chartRequestsFailures'); } catch (e2) {}
    }
  }

  function renderReturningCustomerAnalytics(out) {
    const services = (Array.isArray(out.returningCustomers?.services) ? out.returningCustomers.services : []).slice();
    const customers = (Array.isArray(out.returningCustomers?.customers) ? out.returningCustomers.customers : []).slice();
    const agents = (Array.isArray(out.returningCustomers?.agents) ? out.returningCustomers.agents : []).slice();
    services.sort((a,b) => (Number(b.return_rate||0) - Number(a.return_rate||0)) || (Number(b.returning_customers||0) - Number(a.returning_customers||0)));
    customers.sort((a,b) => (Number(b.return_rate||0) - Number(a.return_rate||0)) || (Number(b.total_serves||0) - Number(a.total_serves||0)));
    agents.sort((a,b) => (Number(b.returning_customers||0) - Number(a.returning_customers||0)) || (Number(b.total_customers||0) - Number(a.total_customers||0)));
    const palette = ['#22c55e', '#0ea5e9', '#a855f7', '#f59e0b', '#ef4444', '#14b8a6', '#6366f1'];

    const formatPct = (value) => `${Number(value || 0).toFixed(2)}%`;
    const escapeHtml = (value) => String(value ?? '').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    // Calculate overall percentages based on total distribution
    const totalCustomerServes = customers.reduce((sum, c) => sum + (Number(c?.total_serves || 0)), 0);
    const totalCustomerReturningServes = customers.reduce((sum, c) => sum + (Number(c?.returning_serves || 0)), 0);
    const totalAgentReturning = agents.reduce((sum, a) => sum + (Number(a?.returning_customers || 0)), 0);

    const renderSummaryCard = ({ id, title, meta, rate, details, color, accentLabel }) => {
      const safeTitle = escapeHtml(title);
      const safeMeta = escapeHtml(meta);
      const safeAccent = escapeHtml(accentLabel || '');
      return `
        <div class="returning-card">
          <button class="returning-head" type="button" data-bs-toggle="collapse" data-bs-target="#${id}" aria-expanded="false" aria-controls="${id}">
            <span class="text-start">
              <span class="returning-title">${safeTitle}</span>
              <span class="returning-meta d-block">${safeMeta}</span>
            </span>
            <span class="text-end d-flex align-items-center justify-content-end gap-2">
              <span class="fw-bold">${formatPct(rate)}</span>
              <span class="returning-meta d-block">${safeAccent}</span>
              <i class="fa fa-chevron-down expand-icon"></i>
            </span>
          </button>
          <div class="returning-progress mt-2">
            <div style="width:${Math.min(100, Math.max(0, rate))}%;background:${color};"></div>
          </div>
          <div id="${id}" class="collapse returning-detail">
            ${details.map((item) => {
              const itemLabel = escapeHtml(item.label || item.phone || item.service || item.agent_name || 'Detail');
              const itemMeta = escapeHtml(item.meta || '');
              return `
                <div class="returning-detail-item">
                  <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                      <div class="fw-semibold">${itemLabel}</div>
                      <div class="small opacity-75">${itemMeta}</div>
                    </div>
                    <div class="text-end">
                      <div class="fw-semibold">${formatPct(item.rate || 0)}</div>
                      <div class="small opacity-75">${item.value || ''}</div>
                    </div>
                  </div>
                  <div class="returning-progress mt-2">
                    <div style="width:${Math.min(100, Math.max(0, item.rate || 0))}%;background:${item.color || color};"></div>
                  </div>
                </div>
              `;
            }).join('')}
          </div>
        </div>
      `;
    };

    const renderSection = (selector, items, builder) => {
      const $body = $(selector);
      if (!$body.length) return;
      if (!items.length) {
        $body.html('<div class="text-muted small">No returning-customer activity found.</div>');
        return;
      }
      $body.html(items.map((item, index) => builder(item, index)).join(''));
    };

    const syncReturningSectionToggle = (button) => {
      if (!button) return;
      const isExpanded = button.getAttribute('aria-expanded') === 'true';
      const icon = button.querySelector('.expand-icon');
      const toggle = button.querySelector('.section-toggle');
      if (toggle) {
        toggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
      }
      if (icon) {
        icon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
      }
    };

    const initializeReturningSectionToggles = () => {
      document.querySelectorAll('#returningAnalytics .returning-section-header').forEach((header) => {
        const targetSelector = header.getAttribute('data-bs-target');
        const target = targetSelector ? document.querySelector(targetSelector) : null;
        const toggle = header.querySelector('.section-toggle');

        header.setAttribute('aria-expanded', 'false');
        if (toggle) {
          toggle.setAttribute('aria-expanded', 'false');
        }
        syncReturningSectionToggle(header);

        if (target) {
          target.addEventListener('shown.bs.collapse', () => {
            header.setAttribute('aria-expanded', 'true');
            if (toggle) toggle.setAttribute('aria-expanded', 'true');
            syncReturningSectionToggle(header);
          });

          target.addEventListener('hidden.bs.collapse', () => {
            header.setAttribute('aria-expanded', 'false');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
            syncReturningSectionToggle(header);
          });
        }

        header.addEventListener('click', (event) => {
          if (!target) return;
          const expanded = header.getAttribute('aria-expanded') === 'true';
          if (typeof bootstrap === 'undefined' || !bootstrap.Collapse) {
            event.preventDefault();
            const nextExpanded = !expanded;
            header.setAttribute('aria-expanded', nextExpanded ? 'true' : 'false');
            if (toggle) {
              toggle.setAttribute('aria-expanded', nextExpanded ? 'true' : 'false');
            }
            target.classList.toggle('show', nextExpanded);
            syncReturningSectionToggle(header);
          }
        });
      });
    };

    renderSection('#returningServiceBody', services, (item, index) => {
      const detailRows = (Array.isArray(item?.customers) ? item.customers : []).map((customer) => ({
        label: customer?.phone || 'Unknown Customer',
        meta: `${Number(customer?.total_serves || 0).toLocaleString()} visits • ${Number(customer?.returning_serves || 0).toLocaleString()} returns`,
        value: `${Number(customer?.returning_serves || 0).toLocaleString()} returning`,
        rate: Number(customer?.return_rate || 0),
        color: palette[index % palette.length],
      }));

      return renderSummaryCard({
        id: `service-return-${index}`,
        title: item?.service || 'Service',
        meta: `${Number(item?.total_customers || 0).toLocaleString()} customers • ${Number(item?.returning_customers || 0).toLocaleString()} returning`,
        rate: Number(item?.return_rate || 0),
        details: detailRows,
        color: palette[index % palette.length],
        accentLabel: 'Return rate',
      });
    });

    renderSection('#returningCustomerBody', customers, (item, index) => {
      const detailRows = (Array.isArray(item?.services) ? item.services : []).map((service, serviceIndex) => {
        const serviceTotalServes = Number(service?.total_serves || 0);
        const serviceRate = serviceTotalServes > 0 ? (Number(service?.returning_serves || 0) / serviceTotalServes) * 100 : 0;
        return {
          label: service?.service || 'Service',
          meta: `${serviceTotalServes.toLocaleString()} visits`,
          value: `${Number(service?.returning_serves || 0).toLocaleString()} returning`,
          rate: serviceRate,
          color: palette[serviceIndex % palette.length],
        };
      });

      const totalServes = Number(item?.total_serves || 0);
      const overallRate = totalServes > 0 ? (Number(item?.returning_serves || 0) / totalServes) * 100 : 0;

      return renderSummaryCard({
        id: `customer-return-${index}`,
        title: item?.phone || 'Customer',
        meta: `${Number(item?.total_serves || 0).toLocaleString()} visits • ${Number(item?.returning_serves || 0).toLocaleString()} returns`,
        rate: overallRate,
        details: detailRows,
        color: palette[index % palette.length],
        accentLabel: 'Overall',
      });
    });

    renderSection('#returningAgentBody', agents, (item, index) => {
      const detailRows = (Array.isArray(item?.services) ? item.services : []).map((service, serviceIndex) => ({
        label: service?.service || 'Service',
        meta: `${Number(service?.total_customers || 0).toLocaleString()} customers`,
        value: `${Number(service?.returning_customers || 0).toLocaleString()} returning`,
        rate: Number(service?.return_rate || 0),
        color: palette[serviceIndex % palette.length],
      }));

      const returningCustomers = Number(item?.returning_customers || 0);
      const totalCustomers = Number(item?.total_customers || 0);
      const overallRate = totalCustomers > 0 ? (returningCustomers / totalCustomers) * 100 : 0;

      return renderSummaryCard({
        id: `agent-return-${index}`,
        title: item?.agent_name || 'Agent',
        meta: `${returningCustomers.toLocaleString()} returning customers • ${totalCustomers.toLocaleString()} customers`,
        rate: overallRate,
        details: detailRows,
        color: palette[index % palette.length],
        accentLabel: 'Overall',
      });
    });
  }

  function renderDashboard(out) {
    const meta = out.meta || {};
    const totalUsers = parseInt(meta.total_users, 10) || 0;
    const presentOrLateToday = parseInt(meta.present_or_late_today, 10) || 0;
    const canViewReturningAnalytics = Boolean(<?= (user_can('is_manager') || user_can('is_admin')) ? 'true' : 'false' ?>);
    const canViewLoyaltyMetrics = canViewReturningAnalytics;
    const cashpickupsTotal = parseInt(meta.cashpickups_total, 10) || 0;
    const cashpickupsApproved = parseInt(meta.cashpickups_approved, 10) || 0;
    const cashpickupsPending = parseInt(meta.cashpickups_pending, 10) || 0;
    const cashpickupsDraft = parseInt(meta.cashpickups_draft, 10) || 0;
    const topRoles = meta.top_roles || [];

    try {
      const dbg = {
        meta: {
          cashpickups_total: meta.cashpickups_total,
          cashpickups_error: meta.cashpickups_error,
          cashpickups_can_view_all: meta.cashpickups_can_view_all,
          cashpickups_approved: meta.cashpickups_approved,
          cashpickups_pending: meta.cashpickups_pending,
          cashpickups_draft: meta.cashpickups_draft,
          cashpickups_denied: meta.cashpickups_denied,
        },
        cashpickups: {
          Overview: out.cashpickups?.Overview,
          By_Approval: out.cashpickups?.By_Approval,
          By_Status: out.cashpickups?.By_Status,
          By_Side: out.cashpickups?.By_Side,
          By_Side_Approval: out.cashpickups?.By_Side_Approval,
        }
      };
      window.__dashCashpickupDebug = dbg;
      console.log('dashboard cashpickup debug:', dbg);
    } catch (e) {
    }

    const coreMetrics = [];
    if (canViewLoyaltyMetrics) {
      const loyaltyPct = Number(meta.overall_returning?.returning_rate || 0);
      const loyaltyTotalCustomers = Number(meta.overall_returning?.total_customers || 0);
      const loyaltyReturning = Number(meta.overall_returning?.total_returning_customers || 0);
      const loyaltyCountsText = `${loyaltyReturning.toLocaleString()} returning / ${loyaltyTotalCustomers.toLocaleString()} total`;
      coreMetrics.push({
        id: 'returning_loyalty',
        icon: 'fa-heart',
        label: 'Loyalty',
        value: loyaltyPct,
        isPercent: true,
        countsText: loyaltyCountsText,
      });
      coreMetrics.push({
        id:    'presentLateToday',
        icon:  'fa-user-check',
        label: 'Staff Present',
        value: presentOrLateToday,
        volume: presentOrLateToday
      });
    }

    const activityMetrics = [
      { id: 'agency_Bankings', icon: 'fa-landmark', count: out.agencybankings?.Overview?.total_transactions, amount: out.agencybankings?.Overview?.total_amount },
      { id: 'airtime_&_Bundles', icon: 'fa-phone-alt', count: out.airtimebundles?.Overview?.total_transactions, amount: out.airtimebundles?.Overview?.total_amount },
      { id: 'cashpickups', icon: 'fa-hand-holding-dollar', count: out.cashpickups?.Overview?.total_transactions, amount: out.cashpickups?.Overview?.total_amount },
      { id: 'cfas', icon: 'fa-file-invoice', count: out.cfas?.Summary?.total_transactions, amount: out.cfas?.Summary?.total_amount },
      { id: 'ezwichs', icon: 'fa-credit-card', count: out.ezwichs?.Overview?.total_customers, amount: out.ezwichs?.Overview?.total_amount },
      { id: 'momo_&_Remits', icon: 'fa-wallet', count: out.momoremits?.Overview?.customers_served, amount: out.momoremits?.Overview?.total_amount },
      { id: 'agent_services', icon: 'fa-briefcase', count: out.agent_services?.Summary?.total_transactions, amount: out.agent_services?.Summary?.total_amount },
      { id: 'payments', icon: 'fa-hand-holding-usd', count: out.payments?.Summary?.total_transactions, amount: out.payments?.Summary?.total_amount },
      { id: 'payment_services', icon: 'fa-concierge-bell', count: out.payment_services?.Summary?.total_customers, amount: out.payment_services?.Summary?.total_amount },
      { id: 'reversals', icon: 'fa-undo', count: out.reversals?.Summary?.total_transactions, amount: out.reversals?.Summary?.total_amount },
      { id: 'sims', icon: 'fa-sim-card', count: out.sims?.Summary?.total_quantity, amount: out.sims?.Summary?.total_amount },
      { id: 'tickets', icon: 'fa-ticket-alt', count: (out.tickets?.By_Status || []).reduce((sum, t) => sum + (t.count||0), 0), amount: 0 },
      //['withdrawals',       'fa-money-check-alt', out.withdrawals?.Overview?.total_transactions],
      // duplicate transactions to illustrate you can include it again:
     // ['transactions',      'fa-list',            out.transactions?.Overview?.transaction_count]
    ].map((item) => ({
      id: item.id,
      icon: item.icon,
      label: item.label || item.id.replace(/([A-Z])/g, ' $1').replace(/_/g, ' ').replace(/^\w/, c => c.toUpperCase()),
      raw: Number(item.count || 0),
      value: Number(item.count || 0),
      amount: Number(item.amount || 0),
    }));

    console.log(['activityMetrics', activityMetrics]);

    const toRender = coreMetrics.concat(activityMetrics);
    // 4) Render
    $('#metricsRow').empty();
    toRender.forEach(m => {
      const amountText = m.amount ? `₵${m.amount.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2})}` : '';
      const displayValue = m.isPercent ? `${Number(m.value || 0).toFixed(2)}%` : (m.value || 0);
      $('#metricsRow').append(`
          <div class="col-xl-2 col-lg-3 col-md-6 col-sm-4 col-6 mb-3">
            <div class="card-ash metric-card" role="group" aria-label="${m.label}: ${displayValue}">
              <span class="metric-card-icon" aria-hidden="true"><i class="fa ${m.icon}"></i></span>
              <div class="metric-card-copy">
                <span class="metric-card-label">${m.label}</span>
                <h4 class="metric-card-value" id="${m.id}">${displayValue}</h4>
                ${m.countsText ? `<span class="metric-card-support">${m.countsText}</span>` : ''}
                ${amountText ? `<span class="metric-card-support">${amountText}</span>` : ''}
              </div>
              <canvas class="sparkline" id="spark_${m.id}" aria-hidden="true"></canvas>
            </div>
          </div>
        `);
    });

    renderRoleDistribution(topRoles, totalUsers);

    let cashpickupsPaidOut = 0;
    try {
      const byStatus = out.cashpickups?.By_Status || [];
      cashpickupsPaidOut = (Array.isArray(byStatus) ? byStatus : [])
        .filter(r => r && typeof r.status === 'string' && /paid\s*out|paid_out|payout|paid/i.test(r.status))
        .reduce((s, r) => s + (parseInt(r.total_count, 10) || 0), 0);
    } catch (e) {
    }

    renderCashpickupStatusDistribution({
      pending: cashpickupsPending,
      approved: cashpickupsApproved,
      paid_out: cashpickupsPaidOut,
      draft: cashpickupsDraft,
    }, out, meta);

    renderAgencyBankingDistribution(out);
    renderMomoRemitsDistribution(out);
    renderAirtimebundleDistribution(out);
    if (canViewReturningAnalytics) {
      renderReturningCustomerAnalytics(out);
    }

    (function roleBasedSections(){
      const roles = Array.isArray(meta.roles) ? meta.roles : (meta.roles ? [meta.roles] : []);
      const rolesLc = roles.map(r => String(r || '').toLowerCase().trim());
      const primary = String(meta.primary_role || '').toLowerCase().trim();
      const isRestrictedAgent = rolesLc.includes('momo agent') || rolesLc.includes('solo agent') || primary === 'momo agent' || primary === 'solo agent';

      if (isRestrictedAgent) {
        $('#roleDistRow').hide();
        $('#agencyDistRow').hide();
        $('#momoDistRow').hide();
        $('#airtimeDistRow').hide();
      }

      $('#opsInsightsRow').toggle(!isRestrictedAgent);
      $('#volumeInsightsRow').toggle(!isRestrictedAgent);

      if (!isRestrictedAgent) {
        renderPaymentServicesByCategory(out);
        renderTicketsStatus(out);
        renderTransactionsByType(out);
        renderEzwichInsights(out);
        renderAirtimebundleTransactions(out);
        renderRequestsHealth(out);
      } else {
        try {
          destroyAndClear('chartTicketsStatus');
          destroyAndClear('chartRequestsFailures');
          destroyAndClear('chartTransactionsByType');
          destroyAndClear('chartEzwichStatus');
          destroyAndClear('chartEzwichTrend');
          destroyAndClear('chartAirtimebundleTx');
        } catch (e) {}
      }
    })();

    // 3) Sparklines (last 7 days)
    const byDate = out.transactions?.By_Date || [];
    const dates  = byDate.slice(-7).map(r => r.date);
    const counts = byDate.slice(-7).map(r => r.count);

    renderSpark('spark_totalTx', dates, counts);

    // 4) Main charts

    // ── Attendance stacked ──
    const attSum = out.attendance?.Summary || [];
    if (attSum.length) {
      renderAttendanceProgBars(attSum);
    }

    toggleChartCard('chartAttendance', attSum.length > 0);

    // ── Cashpickup overview ──
    const cpByDate = out.cashpickups?.By_Date || [];
    if (cpByDate.length) {
      renderDual(
        'chartCashpickupOverview',
        cpByDate.map(r => r.date),
        cpByDate.map(r => r.count || 0),
        cpByDate.map(r => r.amount || 0),
        'Count','Amount'
      );
    }
    toggleChartCard('chartCashpickupOverview', cpByDate.length > 0);

    // 8) Gender Breakdown
    /*const ag = out.attendance?.By_Gender || [];
    renderPie(
      'chartGender',
      ag.map(r => r.gender),
      ag.map(r => r.count)
    );*/

    // 9) Recent Transactions were previously shown in a table.
    // That table has been removed, so we no longer initialise DataTables here.
  }

  // Utility to clear or destroy a missing chart
  function destroyAndClear(canvasId) {
    if (chartInstances[canvasId]) {
      chartInstances[canvasId].destroy();
    }
    const el = document.getElementById(canvasId);
    if (!el || !el.getContext) return;
    const ctx = el.getContext('2d');
    if (!ctx) return;
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
  }

  // Chart helpers
  function renderSpark(el, labels, data){
    const canvas = document.getElementById(el);
    if (!canvas || !canvas.getContext) return;
    if (chartInstances[el]) chartInstances[el].destroy();
    chartInstances[el] = new Chart(canvas, {
      type:'line', data:{labels,datasets:[{data,fill:false,borderColor:'#ffc107',tension:0.3}]},
      options:{plugins:{legend:{display:false}},scales:{x:{display:false},y:{display:false}}}
    });
  }
  function renderLine(el, labels, data, label){
    const canvas = document.getElementById(el);
    if (!canvas || !canvas.getContext) return;
    if (chartInstances[el]) chartInstances[el].destroy();
    chartInstances[el] = new Chart(canvas, {
      type:'line', data:{labels,datasets:[{label,data,borderColor:'#ffc107',backgroundColor:'rgba(255,193,7,0.2)',fill:true}]},
      options:{scales:{y:{beginAtZero:true}}}
    });
  }
  function renderDual(el, labels, data1, data2, l1, l2){
    const canvas = document.getElementById(el);
    if (!canvas || !canvas.getContext) return;
    if (chartInstances[el]) chartInstances[el].destroy();
    chartInstances[el] = new Chart(canvas, {
      type:'line',
      data:{labels,datasets:[
        {label:l1,data:data1,borderColor:'#ffc107',backgroundColor:'rgba(255,193,7,0.2)',yAxisID:'y1'},
        {label:l2,data:data2,borderColor:'#888',backgroundColor:'rgba(128,128,128,0.2)',yAxisID:'y2'}
      ]},
      options:{scales:{y1:{type:'linear',position:'left',beginAtZero:true},y2:{type:'linear',position:'right',beginAtZero:true,grid:{drawOnChartArea:false}}}}
    });
  }
  function renderBar(el, labels, data, label){
    const canvas = document.getElementById(el);
    if (!canvas || !canvas.getContext) return;
    if (chartInstances[el]) chartInstances[el].destroy();
    chartInstances[el] = new Chart(canvas, {
      type:'bar', data:{labels,datasets:[{label,data,backgroundColor:'#ffc107'}]}, options:{scales:{y:{beginAtZero:true}}}
    });
  }
  function renderPie(el, labels, data){
    const canvas = document.getElementById(el);
    if (!canvas || !canvas.getContext) return;
    if (chartInstances[el]) chartInstances[el].destroy();
    const palette = ['#22c55e','#0ea5e9','#a855f7','#f59e0b','#ef4444','#14b8a6','#6366f1','#f97316'];
    chartInstances[el] = new Chart(canvas, {
      type:'doughnut', data:{labels,datasets:[{data,backgroundColor:labels.map((_, i) => palette[i % palette.length])}]},
      options:{plugins:{legend:{position:'bottom'}}}
    });
  }
  function renderBarStacked(el, labels, dataA, dataB, dataC, labelA, labelB, labelC){
    const c = document.getElementById(el);
    if (!c || !c.getContext) return;
    const ctx = c.getContext('2d');
    if (chartInstances[el]) chartInstances[el].destroy();

    const isSmall = (window && window.matchMedia) ? window.matchMedia('(max-width: 991px)').matches : false;
    const isXs = (window && window.matchMedia) ? window.matchMedia('(max-width: 575px)').matches : false;
    try {
      if (isSmall && Array.isArray(labels) && labels.length) {
        const perRow = isXs ? 34 : 30;
        const cap = isXs ? 560 : 480;
        const desired = Math.max(150, Math.min(cap, labels.length * perRow));
        if (c.height !== desired) c.height = desired;
      } else {
        if (c.height < 150) c.height = 150;
      }
    } catch (e) {}
    const maxChars = isSmall ? 12 : 18;

    function ellipsize(s, n){
      s = String(s ?? '').trim();
      if (!s) return '';
      if (s.length <= n) return s;
      return s.slice(0, Math.max(0, n - 1)).trimEnd() + '…';
    }

    chartInstances[el] = new Chart(ctx,{
      type:'bar',
      data:{labels,datasets:[
        {label:labelA,data:dataA,backgroundColor:'#20c997',stack:'s',categoryPercentage:0.72,barPercentage:0.72,borderRadius:2},
        {label:labelB,data:dataB,backgroundColor:'#ffc107',stack:'s',categoryPercentage:0.72,barPercentage:0.72,borderRadius:2},
        {label:labelC,data:dataC,backgroundColor:'#dc3545',stack:'s',categoryPercentage:0.72,barPercentage:0.72,borderRadius:2}
      ]},
      options:{
        indexAxis:'y',
        layout:{padding:{left: isSmall ? 40 : 8, right: 8}},
        scales:{
          x:{stacked:true,beginAtZero:true},
          y:{
            stacked:true,
            afterFit: function(scale) {
              try {
                if (isSmall) {
                  scale.width = Math.max(scale.width, 200);
                }
              } catch (e) {}
            },
            ticks:{
              autoSkip:false,
              maxRotation:0,
              minRotation:0,
              font:{size:isXs ? 9 : (isSmall ? 10 : 12)},
              padding:isXs ? 8 : (isSmall ? 12 : 10),
              callback:function(v){
                const raw = this.getLabelForValue(v);
                return isSmall ? ellipsize(raw, maxChars) : raw;
              }
            }
          }
        },
        plugins:{
          legend:{position:'bottom'},
          tooltip:{
            callbacks:{
              title:function(items){
                if (!items || !items.length) return '';
                const i = items[0].dataIndex;
                const full = Array.isArray(labels) ? labels[i] : items[0].label;
                return String(full ?? '');
              }
            }
          }
        }
      }
    });
  }

  function renderAttendanceProgBars(rows){
    const $body = $('#attendanceProgBody');
    const $canvas = $('#chartAttendance');
    if (!$body.length) return;
    rows = Array.isArray(rows) ? rows : [];

    if (!rows.length) {
      $body.empty();
      $canvas.hide();
      return;
    }
    $canvas.hide();
    const legend = `
      <div style="display:flex;gap:14px;align-items:center;flex-wrap:wrap;margin-bottom:10px;opacity:0.9;font-size:0.85rem;">
        <div style="display:flex;align-items:center;gap:6px;"><span style="width:10px;height:10px;border-radius:999px;background:#20c997;display:inline-block;"></span><span>Present</span></div>
        <div style="display:flex;align-items:center;gap:6px;"><span style="width:10px;height:10px;border-radius:999px;background:#ffc107;display:inline-block;"></span><span>Late</span></div>
        <div style="display:flex;align-items:center;gap:6px;"><span style="width:10px;height:10px;border-radius:999px;background:#dc3545;display:inline-block;"></span><span>Absent</span></div>
      </div>
    `;
    function safeText(s){ return $('<div>').text(String(s ?? '')).html(); }
    function labelOf(r){
      const fn = String(r?.first_name ?? '').trim();
      const ln = String(r?.last_name ?? '').trim();
      const nm = `${fn} ${ln}`.trim();

      if (nm) return nm;
      const full = String(r?.full_name ?? r?.name ?? r?.username ?? '').trim();
      if (full) return full;
      const id = String(r?.id ?? r?.user_id ?? '').trim();
      if (id) return `User ${id}`;
      return 'Unknown';
    }

    const clean = rows.map(function(r){
      const p = parseInt(r?.days_present ?? 0, 10) || 0;
      const l = parseInt(r?.days_late ?? 0, 10) || 0;
      const a = parseInt(r?.days_absent ?? 0, 10) || 0;
      return {
        label: labelOf(r),
        present: p,
        late: l,
        absent: a,
        total: p + l + a,
      };
    }).filter(function(r){ return r.total > 0; });
    clean.sort(function(x, y){ return (y.total || 0) - (x.total || 0); });

    function buildAttendanceBar(r){
      const denom = r.total || 1;
      const pPct = Math.round((r.present / denom) * 100);
      const lPct = Math.round((r.late / denom) * 100);
      const aPct = Math.max(0, 100 - pPct - lPct);
      const lbl = safeText(r.label);
      return `
        <div style="display:flex;gap:12px;align-items:center;margin-bottom:12px;">
          <div style="width:140px;min-width:140px;max-width:140px;font-weight:600;opacity:0.9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${lbl}">${lbl}</div>
          <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:6px;">
              <div></div>
              <div style="opacity:0.85;font-size:0.85rem;white-space:nowrap;">${r.total}</div>
            </div>
            <div style="height:18px;background:rgba(255,255,255,0.08);border-radius:999px;overflow:hidden;display:flex;">
              <div style="width:${pPct}%;background:#20c997;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:600;color:#0b1f16;white-space:nowrap;overflow:hidden;">${r.present ? r.present : ''}</div>
              <div style="width:${lPct}%;background:#ffc107;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:600;color:#1a1400;white-space:nowrap;overflow:hidden;">${r.late ? r.late : ''}</div>
              <div style="width:${aPct}%;background:#dc3545;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;">${r.absent ? r.absent : ''}</div>
            </div>
          </div>
        </div>
      `;
    }

    const visibleRows = clean.slice(0, 5);
    const hiddenRows = clean.slice(5);
    const visibleHtml = visibleRows.map(buildAttendanceBar).join('');
    let hiddenHtml = '';

    if (hiddenRows.length) {
      hiddenHtml = `
        <div id="attendanceProgHidden" style="display:none;">
          ${hiddenRows.map(buildAttendanceBar).join('')}
        </div>
        <div style="text-align:center; margin-top:8px;">
          <button id="attendanceProgToggle" type="button" class="btn btn-sm btn-outline-primary">View more (${hiddenRows.length})</button>
        </div>
      `;
    }

    $body.html(legend + visibleHtml + hiddenHtml);

    if (hiddenRows.length) {
      $body.off('click', '#attendanceProgToggle');
      $body.on('click', '#attendanceProgToggle', function(){
        const $hidden = $('#attendanceProgHidden');
        const isVisible = $hidden.is(':visible');
        $hidden.toggle();
        $(this).text(isVisible ? 'View more (' + hiddenRows.length + ')' : 'View less');
      });
    }
  }

</script>

<?php else:?>
    <div class="alert alert-danger text-center">
        Access denied. You dont have permission for this action
    </div>
    <?php endif;?>