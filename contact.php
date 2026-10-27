<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="section-padding">

    <div class="container">

        <div class="text-center mb-5">

            <p class="text-secondary fw-bold mb-1">
                CONTACT
            </p>

            <h1 class="fw-bold">
                Get In Touch
            </h1>

            <p class="text-muted">
                Have a question? Contact the CareerGuide team.
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-md-5">

                        <form>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter your name"
                                >

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                >

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Message
                                </label>

                                <textarea
                                    class="form-control"
                                    rows="5"
                                    placeholder="Enter your message"
                                ></textarea>

                            </div>

                            <button
                                type="button"
                                class="btn btn-dark px-4"
                                onclick="alert('Thank you for contacting CareerGuide!');"
                            >
                                Send Message
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>