  <style>
    body {
      background: #f5f5f5;
    }
    .login-container {
      max-width: 950px;
      /*margin: 50px auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1); */
    }
    .left-panel {
      /* background: #a3d2ca; */
      background: #dcebff;
      color: #fff;
      text-align: center;
      padding: 40px;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }
    .left-panel img {
      max-width: 80%;
      height: auto;
    }
    .right-panel {
      /* padding: 40px;
      background: #fff; */
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
    .divider {
      position: relative;
      text-align: center;
      margin: 20px 0;
    }
    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 40%;
      height: 1px;
      background: #ccc;
    }
    .divider::before { left: 0; }
    .divider::after { right: 0; }
    .divider span {
      background: #fff;
      padding: 0 10px;
      color: #777;
      font-size: 14px;
    }
    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 10px;
      cursor: pointer;
      background: #fff;
    }
    .google-btn img {
      width: 20px;
      margin-right: 10px;
    }
    .form-control {
      min-height: 48px;
    }
    .text-theme{
      color: #033c71;
    }
    .btn-primary {
    --bs-btn-color: #fff;
    --bs-btn-bg: #033c71;
    --bs-btn-border-color: #033c71;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #edbd03;
    --bs-btn-hover-border-color: #edbd03;
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #edbd03;
    --bs-btn-active-border-color: #033c71;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: #033c71;
    --bs-btn-disabled-border-color: #033c71;
}
.link-hover:hover{
  color: #edbd03
}
@media (max-width: 768px) {
  .left-panel img {
    max-width: 60%;
  }
  .form-control {
      min-height: 44px;
  }
  .left-panel{
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
  }
  .right-panel{
    border-top-right-radius: 0px;
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
  }
  .login-container {
    margin: 30px 0;
  }
}
  </style>
