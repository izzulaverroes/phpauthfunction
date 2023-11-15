import pygame
import random

# Initialize Pygame
pygame.init()

# Constants
SCREEN_WIDTH = 300
SCREEN_HEIGHT = 600
BLOCK_SIZE = 30
WHITE = (255, 255, 255)

# Create the screen
screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
pygame.display.set_caption("Tetris")

# Define shapes
SHAPES = [
    [[1, 1, 1, 1]],
    [[1, 1, 1], [1]],
    [[1, 1, 1], [0, 0, 1]],
    [[1, 1, 1], [0, 1]],
    [[1, 1], [1, 1]],
]

# Initialize game variables
clock = pygame.time.Clock()
current_shape = None
current_shape_x = 0
current_shape_y = 0

def draw_shape(shape, x, y):
    for i, row in enumerate(shape):
        for j, value in enumerate(row):
            if value:
                pygame.draw.rect(screen, WHITE, (x + j * BLOCK_SIZE, y + i * BLOCK_SIZE, BLOCK_SIZE, BLOCK_SIZE))

def new_shape():
    global current_shape, current_shape_x, current_shape_y
    current_shape = random.choice(SHAPES)
    current_shape_x = SCREEN_WIDTH // 2 - len(current_shape[0]) * BLOCK_SIZE // 2
    current_shape_y = 0

# Game loop
running = True
while running:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False

    keys = pygame.key.get_pressed()
    if keys[pygame.K_LEFT]:
        current_shape_x -= BLOCK_SIZE
    if keys[pygame.K_RIGHT]:
        current_shape_x += BLOCK_SIZE
    if keys[pygame.K_DOWN]:
        current_shape_y += BLOCK_SIZE

    screen.fill((0, 0, 0))
    draw_shape(current_shape, current_shape_x, current_shape_y)
    
    pygame.display.flip()
    clock.tick(30)

pygame.quit()
