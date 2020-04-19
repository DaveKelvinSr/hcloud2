		class GameWorld {
			
			constructor(canvasId) {
				this.canvas = null;
				this.cintext = null;
				this.oldTimeStamp = 0;
				this.gameObjects = [];
				this.init(canvasId);
			}
			
			
			init(canvasId) {
				
				// Get a reference to the canvas
				this.canvas = document.getElementById(canvasId);
				this.context = canvas.getContext('2d');
				
				this.createWorld();
				
				// Start the first frame request
				window.requestAnimationFrame((timeStamp) => {this.gameLoop(timeStamp)});
			}
			
			
			createWorld() {
				this.gameObjects = [
					new RectImage(this.context, 250, 50, 0, 50, 1),
					new RectImage(this.context, 250, 300, 0, -50, 1),
					new RectImage(this.context, 150, 0, 50, 50, 1),
					new RectImage(this.context, 250, 150, 50, 50, 1),
					new RectImage(this.context, 350, 75, -50, 50, 1),
					new RectImage(this.context, 300, 300, 50, -50, 1),
					new RectImage(this.context, 125, 50, 0, 50, 1),
					new RectImage(this.context, 125, 300, 0, -50, 1),
					new RectImage(this.context, 75, 0, 50, 50, 1),
					new RectImage(this.context, 125, 150, 50, 50, 1),
					new RectImage(this.context, 175, 75, -50, 50, 1),
					new RectImage(this.context, 150, 300, 50, -50, 1),
					new RectImage(this.context, 250, 25, 0, 50, 1),
					new RectImage(this.context, 250, 150, 0, -50, 1),
					new RectImage(this.context, 150, 100, 50, 50, 1),
					new RectImage(this.context, 250, 75, 50, 50, 1),
					new RectImage(this.context, 350, 37, -50, 50, 1),
					new RectImage(this.context, 300, 150, 50, -50, 1),
					new RectImage(this.context, 225, 50, 0, 50, 1),
					new RectImage(this.context, 325, 300, 0, -50, 1),
					new RectImage(this.context, 475, 0, 50, 50, 1),
					new RectImage(this.context, 525, 150, 50, 50, 1),
					new RectImage(this.context, 675, 75, -50, 50, 1),
					new RectImage(this.context, 750, 300, 50, -50, 1),
					new RectImage(this.context, 850, 25, 0, 50, 1),
					new RectImage(this.context, 950, 150, 0, -50, 1),
					new RectImage(this.context, 1150, 100, 50, 50, 1),
					new RectImage(this.context, 1250, 75, 50, 50, 1),
					new RectImage(this.context, 1350, 37, -50, 50, 1),
					new RectImage(this.context, 1300, 150, 50, -50, 1),
					new RectImage(this.context, 2125, 50, 0, 50, 1),
					new RectImage(this.context, 1925, 300, 0, -50, 1),
					new RectImage(this.context, 1475, 0, 50, 50, 1),
					new RectImage(this.context, 1525, 150, 50, 50, 1),
					new RectImage(this.context, 1675, 75, -50, 50, 1),
					new RectImage(this.context, 1750, 300, 50, -50, 1),
					new RectImage(this.context, 1850, 25, 0, 50, 1),
					new RectImage(this.context, 1950, 150, 0, -50, 1),
					new RectImage(this.context, 450, 100, 50, 50, 1),
					new RectImage(this.context, 550, 75, 50, 50, 1),
					new RectImage(this.context, 650, 37, -50, 50, 1),
					new RectImage(this.context, 700, 150, 50, -50, 1)
				]
			}
	
			
			gameLoop(timeStamp) {
				
				// Calculate how much time has passed
				var secondsPassed = (timeStamp - this.oldTimeStamp) / 1000;
				this.oldTimeStamp = timeStamp;
				
				// Loop over all game objects
				for (var i = 0; i < this.gameObjects.length; i++) {
					// Update game objects in the loop
					this.gameObjects[i].update(secondsPassed);
				}

				this.detectRectangularEscapees();
				this.detectCollisions();
				//this.detectBorders();
				this.clearCanvas();
				
				// Do the same to draw
				for (var i = 0; i < this.gameObjects.length; i++) {
					this.gameObjects[i].draw();
				}
				
				
				// Keep requesting new frames
				window.requestAnimationFrame((timeStamp) => this.gameLoop(timeStamp));
				
				
			}
			
			
			detectCollisions() {
				var obj1;
				var obj2;
				
				// Reset collision state of all objects
				for (var i = 0; i < this.gameObjects.length; i++) {
					this.gameObjects[i].isColliding = false;
				}
				
				// Start checking for collisions
				for (var i = 0; i < this.gameObjects.length; i++) {
					obj1 = this.gameObjects[i];
					for (var j = i + 1; j < this.gameObjects.length; j++) {
						obj2 = this.gameObjects[j];
						
						// Compare object1 with object2
						if (this.rectIntersect(obj1.x, obj1.y, obj1.width, obj1.height,
								obj2.x, obj2.y, obj2.width, obj2.height)) {
							obj1.isColliding = true;
							obj2.isColliding = true;
							
	
							
							var vCollision = {x: obj2.x - obj1.x, y: obj2.y - obj1.y};
							var distance = Math.sqrt((obj2.x-obj1.x)*(obj2.x-obj1.x) + (obj2.y-obj1.y)*(obj2.y-obj1.y));
							var vCollisionNorm = {x: vCollision.x / distance, y: vCollision.y / distance};
							var vRelativeVelocity = {x: obj1.vx - obj2.vx, y: obj1.vy - obj2.vy};
							var speed = vRelativeVelocity.x * vCollisionNorm.x + vRelativeVelocity.y * vCollisionNorm.y;
							
							if (speed < 0) {
								return;
							}
							
							var impulse = 2 * speed / (obj1.mass + obj2.mass);
							obj1.vx -= (impulse * obj2.mass * vCollisionNorm.x);
							obj1.vy -= (impulse * obj2.mass * vCollisionNorm.y);
							obj2.vx += (impulse * obj1.mass * vCollisionNorm.x);
							obj2.vy += (impulse * obj1.mass * vCollisionNorm.y);
						}
					}
				}
			}
			
			
			detectBorders() {
				var obj;
				var obj2;
				
				// Reset collision state of all objects
				for (var i = 0; i < this.gameObjects.length; i++) {
					this.gameObjects[i].isBorderColliding = false;
				}
				
				// Start checking for collisions
				for (var i = 0; i < this.gameObjects.length; i++) {
					obj = this.gameObjects[i];
						
					// Compare object1 with object2
					if (obj.x-obj.radius <= 0) {
						obj.isBorderColliding = true;
						

						
						var vCollision = {x: 0 - obj.x, y: obj.y - obj.y};
						var distance = obj.radius;
						var vCollisionNorm = {x: vCollision.x / distance, y: vCollision.y / distance};
						var vRelativeVelocity = {x: obj.vx - 0, y: obj.vy - 0};
						var speed = vRelativeVelocity.x * vCollisionNorm.x + vRelativeVelocity.y * vCollisionNorm.y;
						
						if (speed < 0) {
							return;
						}

						var impulse = 2 * speed / (obj.mass + obj.mass);
						obj.vx -= 2*(impulse * obj.mass * vCollisionNorm.x);
						obj.vy -= 2*(impulse * obj.mass * vCollisionNorm.y);
						
					}
					if (obj.y-obj.radius <= 0) {
						obj.isBorderColliding = true;
						

						
						var vCollision = {x: obj.x - obj.x, y: 0 - obj.y};
						var distance = obj.radius;
						var vCollisionNorm = {x: vCollision.x / distance, y: vCollision.y / distance};
						var vRelativeVelocity = {x: obj.vx - 0, y: obj.vy - 0};
						var speed = vRelativeVelocity.x * vCollisionNorm.x + vRelativeVelocity.y * vCollisionNorm.y;
						
						if (speed < 0) {
							return;
						}

						var impulse = 2 * speed / (obj.mass + obj.mass);
						obj.vx -= 2*(impulse * obj.mass * vCollisionNorm.x);
						obj.vy -= 2*(impulse * obj.mass * vCollisionNorm.y);
						
					}
					if (obj.x+obj.radius >= canvas.width) {
						obj.isBorderColliding = true;
						

						
						var vCollision = {x: canvas.width - obj.x, y: obj.y - obj.y};
						var distance = obj.radius;
						var vCollisionNorm = {x: vCollision.x / distance, y: vCollision.y / distance};
						var vRelativeVelocity = {x: obj.vx - 0, y: obj.vy - 0};
						var speed = vRelativeVelocity.x * vCollisionNorm.x + vRelativeVelocity.y * vCollisionNorm.y;
						
						if (speed < 0) {
							return;
						}

						var impulse = 2 * speed / (obj.mass + obj.mass);
						obj.vx -= 2*(impulse * obj.mass * vCollisionNorm.x);
						obj.vy -= 2*(impulse * obj.mass * vCollisionNorm.y);
						
					}
					if (obj.y+obj.radius >= canvas.height) {
						obj.isBorderColliding = true;
						

						
						var vCollision = {x: obj.x - obj.x, y: canvas.height - obj.y};
						var distance = obj.radius;
						var vCollisionNorm = {x: vCollision.x / distance, y: vCollision.y / distance};
						var vRelativeVelocity = {x: obj.vx - 0, y: obj.vy - 0};
						var speed = vRelativeVelocity.x * vCollisionNorm.x + vRelativeVelocity.y * vCollisionNorm.y;
						
						if (speed < 0) {
							return;
						}

						var impulse = 2 * speed / (obj.mass + obj.mass);
						obj.vx -= 2*(impulse * obj.mass * vCollisionNorm.x);
						obj.vy -= 2*(impulse * obj.mass * vCollisionNorm.y);
						
					}
				}
			}
			
			
			detectCircularEscapees() {
				var obj;
				
				// Reset collision state of all objects
				for (var i = 0; i < this.gameObjects.length; i++) {
					this.gameObjects[i].isBorderColliding = false;
				}
				
				// Start checking for collisions
				for (var i = 0; i < this.gameObjects.length; i++) {
					obj = this.gameObjects[i];
						
					// Compare object1 with object2
					if (obj.x < 0 - obj.radius || obj.y < 0 - obj.radius || obj.x > canvas.width + obj.radius || obj.y > canvas.height + obj.radius) {
						obj.isBorderColliding = true;

						obj.x = Math.random()*canvas.width;
						obj.y = Math.random()*canvas.height;
						obj.vx = Math.random() >0.5? 50 : -50;
						obj.vy = Math.random() >0.5? 50 : -50;
						
					}
				}
			}
			
			
			detectRectangularEscapees() {
				var obj;
				
				// Reset collision state of all objects
				for (var i = 0; i < this.gameObjects.length; i++) {
					this.gameObjects[i].isBorderColliding = false;
				}
				
				// Start checking for collisions
				for (var i = 0; i < this.gameObjects.length; i++) {
					obj = this.gameObjects[i];
						
					// Compare object1 with object2
					if (obj.x < 0 - obj.width || obj.y < 0 - obj.height || obj.x > canvas.width + obj.width || obj.y > canvas.height + obj.height) {
						obj.isBorderColliding = true;

						obj.x = Math.random()*canvas.width;
						obj.y = Math.random()*canvas.height;
						obj.vx = Math.random() >0.5? 50 : -50;
						obj.vy = Math.random() >0.5? 50 : -50;
						
					}
				}
			}

			
			clearCanvas() {
				
				//Clear the canvas
				this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
			}
			
			
			rectIntersect(x1, y1, w1, h1, x2, y2, w2, h2) {
				// Check x and y for overlap
				if (x2 > w1 + x1 || x1 > w2 + x2 || y2 > h1 + y1 || y1 > h2 + y2) {
					return false;
				}
				
				return true;
			}
			
			circleIntersect(x1, y1, r1, x2, y2, r2) {
				
				// Calculate the distance between the two circles
				var squareDistance = (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2);
				
				// When the distance is smaller or equal to the sum
				// of the two radii, the circles touch or overlap
				if (squareDistance >= ((r1 + r2) * (r1 + r2))) {
					return false
				}
				
				return true;
			}
		}
		
		
		
		class GameObject {
			constructor (context, x, y, vx, vy, mass) {
				this.context = context;
				this.x = x;
				this.y = y;
				this.vx = vx;
				this.vy = vy;
				this.mass = mass;
				
				this.isColliding = false;
				this.isBorderColliding = false;
			}
		}
		
		class Square extends GameObject {
			constructor (context, x, y, vx, vy, mass) {
				super(context, x, y, vx, vy, mass);
				
				// Set default width and height
				this.width = 50;
				this.height = 50;
			}
			
			draw() {
				
				// Draw a simple square
				this.context.fillStyle = this.isColliding || this.mass > 1 ? '#ff8080' : '#0099b0';
				this.context.fillRect(this.x, this.y, this.width, this.height);
			}
			
			update(secondsPassed) {
				
				// Move with set velocity
				this.x += this.vx * secondsPassed;
				this.y += this.vy * secondsPassed;
			}
			
		}
		
		class RectImage extends GameObject {
			constructor (context, x, y, vx, vy, mass) {
				super(context, x, y, vx, vy, mass);
				
				// Set default width and height
				this.width = 160;
				this.height = 160;
				this.img = new Image();
				this.img.src = "js/img/stethoscope4.png";
			}
			
			draw() {
				
				// Draw a simple rectangular image
				this.context.globalAlpha = 0.2;
				this.context.drawImage(this.img, this.x, this.y, this.width, this.height);
				//this.context.fillStyle = this.isColliding || this.mass > 1 ? '#ff8080' : '#0099b0';
				//this.context.fillRect(this.x, this.y, this.width, this.height);
			}
			
			update(secondsPassed) {
				
				// Move with set velocity
				this.x += this.vx * secondsPassed;
				this.y += this.vy * secondsPassed;
			}
			
		}
		
		class Circle extends GameObject {
			constructor (context, x, y, vx, vy, mass) {
				super(context, x, y, vx, vy, mass);
				
				// Set default width and height
				this.radius = 20;
				this.start = 0;
				this.end = 2 * Math.PI;
				this.dir = true;
			}
			
			draw() {
				
				// Draw a simple square
				this.context.fillStyle = this.isColliding || this.mass > 1 ? '#ff8080' : '#0099b0';
				this.context.beginPath();
				this.context.arc(this.x, this.y, this.radius, this.start, this.end, this.dir);
				this.context.fill();/*
				var img = new Image();
				img.src = "img/mobicure.png"
				img.onload = function() {
					context.drawImage(img, 50, 50);
				}*/
			}
			
			update(secondsPassed) {
				
				// Move with set velocity
				this.x += this.vx * secondsPassed;
				this.y += this.vy * secondsPassed;
			}
			
		}