# Redbubble Coding Test

## Requirements
http://take-home-test.herokuapp.com/full-stack-engineer

## How to run it
First thing first, clone or download the repo to your local machine.

### Docker Container
This implementation is in PHP, and I don't expect most people there to install PHP to check out my code as they are mostly a Rails shop. So I added in Docker support to help them get started quickly.

- Install [Docker](https://docs.docker.com/engine/installation/). (Assuming you all did!)

- Navigate to your directory where the repo has been cloned. Run the following:
  ~~~
  docker build -t redbubble .
  ~~~

- After the image has been built, you can run it simply by
  ~~~
  docker run -ti -v {/path/to/host-dir}:/output redbubble
  ~~~
  Replace `{/path/to/host-dir}` to an **absolute** path on your host machine where you want to check out generated HTML files. The path doesn't have to exist before running this command.
  
- The files should be generated in the `{/path/to/host-dir}` you specified above.

The API endpoint and output dir are hardcoded in the Dockerfile as defaults. If you want to supply a different endpoint or change the output dir, you can extend the `docker run` command, for example:
~~~
docker run -ti -v {host_path}:/app/{new_dir} redbubble {new_endpoint} {new_dir}
~~~
Please note that the `{new_dir}` is being appended to `app` directory inside the container, so the `{new_dir}` can't be an absolute path. This is just due to the `WORKDIR` is set to `/app` in the Dockerfile.

### PHP CLI
If you want to go old-school, you can install php5.6-cli on your machine, and run the following command in your repo directory:
~~~
> composer install
> php processor.php redbubble:images-processor {endpoint} {output_dir}
~~~
`{endpoint}` is the API url, while `{output_dir}` is the directory containing the generated files.

## Design patterns and extendability
The implementation tried to stick to SOLID principles wherever possible and applied some design patterns that allows further extension.

### Strategy
In this project, images are supplied by XML, but what happens if the source is a JSON file or a CSV file? `ProviderInterface` allows you to implement different source providers to convert image data to a collection of domain objects `Image`.
`ImageRepositoryInterface` also gives you flexibility to implement a repository service to retrieve data. At the moment, the image objects are stored in memory, but the repository could be an implementation of a database solution.

### Abstract Factory
When building the HTML output, I have `AbstractPageBuilder` class and `AbstractTemplate` to allow different implementations for index, make and model pages.

## Testing
The implementation is TDD-driven. You can verify the tests as follows:

### Docker
~~~
docker run -ti --entrypoint=vendor/bin/phpunit redbubble
~~~

### PHP CLI
~~~
vendor/bin/phpunit
~~~
