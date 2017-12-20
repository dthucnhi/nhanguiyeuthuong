<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 12/6/2017
 * Time: 1:45 PM
 */
?>
<style>
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
        color: black;
    }
</style>
    <div class="morph-content">
        <div>
            <div class="content-style-form content-style-form-2">
                <div class="button-close">
                    <span class="button-close-icon" aria-hidden="true" data-icon="&#x51;"></span>
                </div>
                <h2>Gửi yêu thương của bạn đến</h2>
                <div class="subscribe">
                    <form >
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>Người ấy:</h3>
                                    <input type="text" placeholder="Nhập tên người ấy" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <h3>SĐT:</h3>
                                    <input type="text" placeholder="Nhập SĐT người ấy" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>Tên bạn:</h3>
                                    <input type="text" placeholder="Nhập tên của bạn" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <h3>SĐT:</h3>
                                    <input type="text" placeholder="Nhập SĐT của bạn" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>File ghi âm 1:</h3>
                                    <input type="file" style="margin-bottom: 10px"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>File ghi âm 2:</h3>
                                    <input type="file"/>
                                </div>
                            </div>
                        </div>

                        <p><button type="submit" class="btn-submit">GỬI</button></p>
                    </form>
                    <div class="success-message"></div>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>
    </div>
