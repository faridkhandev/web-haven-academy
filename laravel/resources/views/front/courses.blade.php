<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
</head>
<body>
    <main>
        <h1>Courses</h1>

        <section>
            <h2>Ignite Program</h2>
            @forelse($courses as $course)
                <article>
                    <h3>{{ $course->course_name }}</h3>
                    @if(!empty($course->course_image))
                        <img src="{{ asset('weblogin/image/'.$course->course_image) }}"
                             alt="{{ $course->course_name }}"
                             loading="lazy">
                    @endif
                </article>
            @empty
                <p>No courses available.</p>
            @endforelse
        </section>

        <section>
            <h2>Elevate Program</h2>
            @forelse($courses2 as $course)
                <article>
                    <h3>{{ $course->course_name }}</h3>
                    @if(!empty($course->course_image))
                        <img src="{{ asset('weblogin/image/'.$course->course_image) }}"
                             alt="{{ $course->course_name }}"
                             loading="lazy">
                    @endif
                </article>
            @empty
                <p>No courses available.</p>
            @endforelse
        </section>
    </main>
</body>
</html>
