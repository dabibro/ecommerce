<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card border shadow-none">
        <div class="card-header border-bottom py-4 px-0 mx-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Profile Details</h4>
                <button class="btn btn-primary">
                              <span class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="Edit Profile" data-bs-original-title="Edit Profile">
                                 <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                          d="M21.101 9.58786H19.8979V8.41162C19.8979 7.90945 19.4952 7.5 18.999 7.5C18.5038 7.5 18.1 7.90945 18.1 8.41162V9.58786H16.899C16.4027 9.58786 16 9.99731 16 10.4995C16 11.0016 16.4027 11.4111 16.899 11.4111H18.1V12.5884C18.1 13.0906 18.5038 13.5 18.999 13.5C19.4952 13.5 19.8979 13.0906 19.8979 12.5884V11.4111H21.101C21.5962 11.4111 22 11.0016 22 10.4995C22 9.99731 21.5962 9.58786 21.101 9.58786Z"
                                          fill="currentColor"></path>
                                    <path d="M9.5 15.0156C5.45422 15.0156 2 15.6625 2 18.2467C2 20.83 5.4332 21.5001 9.5 21.5001C13.5448 21.5001 17 20.8533 17 18.269C17 15.6848 13.5668 15.0156 9.5 15.0156Z"
                                          fill="currentColor"></path>
                                    <path opacity="0.4"
                                          d="M9.50023 12.5542C12.2548 12.5542 14.4629 10.3177 14.4629 7.52761C14.4629 4.73754 12.2548 2.5 9.50023 2.5C6.74566 2.5 4.5376 4.73754 4.5376 7.52761C4.5376 10.3177 6.74566 12.5542 9.50023 12.5542Z"
                                          fill="currentColor"></path>
                                 </svg>
                              </span>
                    <span class="d-none d-md-block">
                                 Edit Profile
                              </span>
                </button>
            </div>
        </div>
        <div class="card-body p-0 pt-3">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <tbody>
                    <tr>
                        <th>Full Name:</th>
                        <td>Elon Musk</td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                        <td>(303) 555-0105</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>265, Hill View, Rochester Avenue. Kentucky - 40062</td>
                    </tr>
                    <tr>
                        <th>Email Id:</th>
                        <td>elon.musk@gmail.com</td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td>*************</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card border shadow-none">
        <div class="card-header border-bottom py-4 px-0 mx-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Profile Details</h4>
            </div>
        </div>
        <div class="card-body">
            <h6 class="mb-2">Avatar</h6>
            <div class="d-flex align-items-center justify-content-center">
                <div class="position-relative">
                    <img src="../e-commerce/assets/images/user/06.png" alt="user-profile"
                         class="img-fluid edit-img border border-white border-4 rounded-circle"
                         loading="lazy">
                    <div class="iq-icon-edit position-absolute btn btn-primary btn-sm rounded-circle p-1">
                        <svg class="upload-button icon-20" width="20" viewBox="0 0 24 24">
                            <path fill="#ffffff"
                                  d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"></path>
                        </svg>
                    </div>
                    <div class="iq-icon-cancel position-absolute btn btn-primary btn-sm rounded-circle p-1">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none">
                            <path d="M17 7L7 17M7 7L17 17L7 7Z" stroke="white" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <p class="text-center">Allowed file type : png, jpg, jpeg</p>
            <form class="mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="contact">Contact Number</label>
                            <input type="text" class="form-control" id="contact" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email ID</label>
                            <input type="text" class="form-control" id="email" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="house">House no./ Flat no.</label>
                            <input type="text" class="form-control" id="house" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="landmark">Landmark</label>
                            <input type="text" class="form-control" id="landmark" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="address">Street Address</label>
                            <input type="text" class="form-control" id="address" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="city">Town/ City</label>
                            <input type="text" class="form-control" id="city" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="state">State/ Country</label>
                            <input type="text" class="form-control" id="state" placeholder=" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="code">Postcode/ ZIP Code</label>
                            <input type="text" class="form-control" id="code" placeholder=" ">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <div class="card border border-dashed border-2 shadow-none mb-0 rounded border-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Secure Your Account</h4>
                <button class="btn btn-primary">Enable</button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24"
                         fill="none" class="text-success">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M11.9845 21.606C11.9845 21.606 19.6565 19.283 19.6565 12.879C19.6565 6.474 19.9345 5.974 19.3195 5.358C18.7035 4.742 12.9905 2.75 11.9845 2.75C10.9785 2.75 5.26551 4.742 4.65051 5.358C4.03451 5.974 4.31251 6.474 4.31251 12.879C4.31251 19.283 11.9845 21.606 11.9845 21.606Z"
                              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path d="M9.38591 11.8746L11.2779 13.7696L15.1759 9.86963"
                              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                </div>
                <p class=" mb-0">Two-factor authentication adds an extra layer of security to your
                    account. To log in, in addition you'll need to provide a 6 digit code</p>
            </div>
        </div>
    </div>
</div>
