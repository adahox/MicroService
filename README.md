# 🐇 PHP RabbitMQ Microservice Playground

A tiny, smile-inducing project that shows how to dispatch and consume queued jobs in PHP using RabbitMQ. Everything is intentionally simple so you can focus on the flow: publish a job, let RabbitMQ hold it, and have a worker pick it up and do the work.

## ✨ What you get
- **Lightweight example** built with plain PHP, [php-amqplib](https://github.com/php-amqplib/php-amqplib), and [PHP-DI](https://php-di.org/).
- **Ready-to-run RabbitMQ** via `docker compose` with the management UI exposed on `http://localhost:15672` (default login: `admin` / `admin`).
- **Job scaffolding** that mirrors a Laravel-like queue flow without the framework overhead.

## 🚀 Quick start
1. **Install dependencies**
   ```bash
   composer install
   ```
2. **Start RabbitMQ** (in the background)
   ```bash
   docker compose up -d
   ```
3. **Run a worker for the `UnfollowJob` queue** (keep this terminal open)
   ```bash
   php queue subscribe:UnfollowJob
   ```
4. **Publish a job** from another terminal
   ```bash
   php index.php
   ```
   You should see the worker log `Executado App\Job\UnfollowJob::handle` and print the email delivery result.

> **Tip:** The RabbitMQ host is configured inside `src/Rabbit/RabbitConnection.php`. Update it to `localhost` (or your Docker host IP) if needed.

## 🧭 How the pieces fit together
1. `UnfollowJob::dispatch($payload)` wraps your data into a JSON message and publishes it to a queue named after the job class.
2. `php queue subscribe:<QueueName>` uses the Rabbit facade to listen for messages and hand them to the job’s `handle` method.
3. The worker echoes a friendly confirmation so you know the job ran.

```
Publisher (index.php) ──▶ RabbitMQ queue ──▶ Worker (php queue subscribe:UnfollowJob)
```

## 🗂️ Project map
- `index.php` — minimal publisher example that dispatches `UnfollowJob`.
- `queue` — tiny CLI entrypoint that subscribes to a queue: `php queue subscribe:<QueueName>`.
- `src/Job/UnfollowJob.php` — example job that simulates sending an email in `handle`.
- `src/Trait/Queue/Queueable.php` — trait that serializes a job and hands it to RabbitMQ.
- `src/Rabbit/*` — RabbitMQ connection helper and publish/subscribe wrapper.
- `docker-compose.yml` — RabbitMQ service with the management UI enabled.

## 🌱 Make your own job
1. Create a class in `src/Job`, implement `App\Contracts\Queue`, and use `Queueable`.
2. Add your logic to the `handle` method.
3. Dispatch it with `YourJob::dispatch($payload);` and subscribe with `php queue subscribe:YourJob`.

Enjoy exploring—may your queues always stay happy and healthy! 🧡
