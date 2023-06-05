class Movable(object):
    x: float
    y: float
    w: float
    h: float

    def move(self, x: float, y: float):
        self.x += x
        self.y += y

    def scale(self, s: float):
        self.w *= s
        self.h *= s


class Entity(object):
    name: str

    def __init__(self, name: str):
        self.name = name


class Human(Entity, Movable):
    pass
