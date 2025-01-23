# Interview Example Project

As a portion of a recent interview process, I was asked to complete several tickets and demonstrate the end-to-end skills needed for the role. Always on the lookout for optimizing my use of resources, I have done so in a reusable repository.

## Background

The organization prompting this sample project runs the TALL stack, with some Laravel Nova and Filament added as major portions of their tooling. During the interview I established that the team did not take up a practice of using static analysis, a tool I find indespensible, and had some TDD practices but wanted to go further.

I did timebox this project to three hours, with execution time being just about 3 hours and 8 minutes. There were two steps that I did not capture timing for on this project, I am estimating an additional 15 minutes for those steps. Total time would be approximately 3 hours and 23 minutes.

I picked approaches that appeared to be new or underused patterns in order to spark conversation. For example, I leveraged the Spatie Data package instead of a simple class.

## Features

This example project had two major functions:

- Provide a generic link archive
    - Include a daily email with any links found offline
- Provide a Reddit top-post style dashboard

It is about as bare-bones as you can get and still demonstrate a reasonable range of basic aptitudes.

## How to grok this project

There are six issues on this repository, each with a seperate PR resolving the needs documented. The PR's are inteded to be handled in numeric order, lowest to highest. I would suggest starting with the first PR and reading the comments, code and commits before moving to higher numbered PR's.

While reading the code keep an eye out for my more verbose comments. There are a couple of places I wanted to draw attention towards. These are intended to be conversation points during a live call.

## Requirements

Though this is a PHP / Laravel project, it was built using [Sail](https://laravel.com/docs/11.x/sail) and should run anywhere that you can install [Docker](https://docs.docker.com/engine/install/). Please reach out if you need help with this setup.