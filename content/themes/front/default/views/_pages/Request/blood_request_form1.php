<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://codepen.io/skjha5993/pen/bXqWpR.css"
    />
    <style>
      body,.form-group label{
        color: black!important;
        font-size: 12px !important;
      } 
.table td, .table th {
    padding: 0.25rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.table td, .table th {
    /* padding: 0.75rem; */
    /* vertical-align: top; */
    border: 1px solid black !important;
    font-size: 14px;
    text-align: center;
}
.table {
    margin-top: 5px;
    width: 100%;
    /* margin-bottom: 1rem; */
    color: #212529;
    margin-bottom: 2px!important;
}
      .header {
        padding-top: 3px;
        /* padding-bottom: 25px; */
      }
      .first-column {
        /* background: green; */
        color: white;
        font-size: 2rem;
        /* border-width: 2px; */
        /* border-color: red; */
        border: 2px solid black;
        /* background: #5851ff; */
        margin-top: 5px;
        /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%); */
        align-items: center;
      }
      /* .float-right {
    float:none!important;
} */
      .second-column {
        /* background: green; */
        color: white;
        font-size: 2rem;
        /* border-width: 2px; */
        /* border-color: red; */
        border: 2px solid black;
        /* background: #5851ff; */
        margin-top: 5px;
        /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%); */
        align-items: center;
      }
      .jumbotron {
        padding: 0rem 0rem;
        background-color: white !important;
      }
      .h2,
      h2 {
        font-size: 1rem;
      }
      .table td,
      .table th {
        /* padding: 0.75rem; */
        /* vertical-align: top; */
        border: 1px solid black !important;
        font-size: 10px;
      }

   
      .col-form-label {
        font-size: 10px;
        /* line-height: 2.5; */
      }
      .container {
        font-size: 10px;
      }
      .mb-0 {
        padding: 26px;
      }
      .form-control {
        padding: 0px 0px;
        height: 20px;
        margin-top: 10px;
      }
      .form-group {
        margin-bottom: 0px !important;
      }
    </style>
 
    <div class="container-fluid">
    <div class="row header" style="border: 1px solid black;padding-bottom: 10px;">
        <div class="col-sm-4">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Registration No:
            </label>
            <div class="col-sm-8">
              <input
                type="text" name="registration"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Date:</label
            >
            <div class="col-sm-8">
              <input
                type="Date"
                name="dob"
                class="form-control"
                id="Date"
                placeholder=""
                required=""
                style="font-size: 12px"
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label">
              Time
            </label>
            <div class="col-sm-8">
              <input
                type="time"
                name="time"
                class="form-control"
                id="Date"
                placeholder=""
                required=""
                style="font-size: 12px"
              />
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Donor Type :
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="donor_type"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Patinet name:
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="patinet"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label">
              Reg No:
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="reg_no"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Father's Name:
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="f_name"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Hospital:
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="hospital"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"
              >Hemoglobin:
            </label>
            <div class="col-sm-8">
              <input
                type="text"
                name="hemoglobin"
                class="form-control"
                id="inputEmail3"
                placeholder=""
              />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-sm-6 first-column">
        <div class="container">
          <form>
            <h2 class="text-center text-danger">
              Patient Profile Information
            </h2>
            <div class="jumbotron">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Mobile No:
                </label>
                <div class="col-sm-8" style="width: 100%">
                  <input
                    type="tel"
                    name="mobile"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Status :</label
                  >
                  <div class="col-sm-8">
                    <select class="form-control" name="status" style="font-size: 10px;">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-6 col-form-label"
                      >Registration No :
                    </label>
                    <div class="col-sm-6">
                      <input
                        type="email"
                        class="form-control"
                        id="inputEmail3"
                        placeholder=""
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Patient Name :
                </label>
                <div class="col-sm-8" style="width: 100%">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Father's Name:
                </label>
                <div class="col-sm-8" style="width: 100%">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Address</label
                >
                <div class="col-sm-8" style="width: 500px">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"
                      >Age
                    </label>
                    <div class="col-sm-8">
                      <input
                        type="email"
                        class="form-control"
                        id="inputEmail3"
                        placeholder=""
                      />
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >DOB
                  </label>
                  <div class="col-sm-8">
                    <input
                      type="email"
                      class="form-control"
                      id="inputEmail3"
                      placeholder=""
                    />
                  </div>
                </div>
               
                <div class="col-sm-6 form-group row">
                  <label for="inputEmail3" class="col-sm-6 col-form-label"
                    >Blood Group :</label
                  >
                  <div class="col-sm-6">
                    <select class="form-control" style="font-size: 12px">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >sex :</label
                  >
                  <div class="col-sm-8">
                    <select class="form-control" style="font-size: 12px">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Address:
                </label>
                <div class="col-sm-8" style="width: 100%">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Mobile:
                </label>
                <div class="col-sm-8" style="width: 100%">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >phone</label
                >
                <div class="col-sm-8" style="width: 500px">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Consaltant</label
                >
                <div class="col-sm-8" style="width: 500px">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group row">
                  <label for="inputEmail3" class="col-sm-6 col-form-label"
                    >required date:</label
                  >
                  <div class="col-sm-6">
                    <input
                      type="date"
                      class="form-control"
                      id="inputEmail3"
                      placeholder=""
                      style="font-size: 12px"
                    />
                  </div>
                </div>
                <div class="col-sm-3 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Time:</label
                  >
                  <div class="col-sm-8">
                    <input
                      type="time"
                      class="form-control"
                      id="inputEmail3"
                      placeholder=""
                      style="font-size: 12px"
                    />
                  </div>
                </div>
                <div class="col-sm-3 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >sex:</label
                  >
                  <div class="col-sm-8">
                    <select class="form-control" style="font-size: 12px">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Consaltant</label
                >
                <div class="col-sm-8" style="width: 500px">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"
                  >Consaltant</label
                >
                <div class="col-sm-8" style="width: 500px">
                  <input
                    type="email"
                    class="form-control"
                    id="inputEmail3"
                    placeholder=""
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-sm-6 second-column">
        <div class="container">
          <form>
            <h2 class="text-danger">Other Details</h2>
            <div class="jumbotron">
              <div class="row">
                <div class="col-sm-4 form-group">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"
                      >Wardno</label
                    >
                    <div class="col-sm-6">
                      <select class="form-control" style="font-size: 12px">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 form-group">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">
                      Bad no
                    </label>
                    <div class="col-sm-6">
                      <input
                        type="email"
                        class="form-control"
                        id="inputEmail3"
                        placeholder=""
                      />
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 form-group">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"
                      >Diagnosis
                    </label>
                    <div class="col-sm-8">
                      <select class="form-control" style="font-size: 12px">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Component</th>
                      <th scope="col">unit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                    
                        <div class="col-sm-12 form-group">
                          <div class="form-group row">
                            <label
                              for="inputEmail3"
                              class="col-sm-6 col-form-label"
                              >Bag Type:
                            </label>
                            <div class="col-sm-6">
                              <input
                                type="email"
                                class="form-control"
                                id="inputEmail3"
                                placeholder=""
                              />
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>


                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-6 form-group mb-0">
                      <button class="btn btn-primary float-right">Reset</button>
                    </div>
                    <div class="col-sm-6 form-group mb-0">
                      <button class="btn btn-primary float-right">Submit</button>
                    </div>
                  </div>              
            </div>
          </form>
        </div>
      </div>
      <div>
    </div>
    </div>
    </div>