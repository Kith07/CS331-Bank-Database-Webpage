import matplotlib.pyplot as plt

def hailstone(n):
    sequence = [n]
    while n != 1:
        if n % 2 == 0:
            n //= 2
        else:
            n = 3 * n + 1
        sequence.append(n)
    return sequence

def reciprocalSum(sequence):
    return sum(1/n for n in sequence)

def graph(start, end):
    for num in range(start, end + 1):
        sequence = hailstone(num)
        rSum = reciprocalSum(sequence)
        plt.plot(num, rSum, 'bo', markersize=3)

    plt.xlabel('Initial Number')
    plt.ylabel('Sum of Reciprocals')
    plt.title('Hailstone Sequence')
    plt.show()

if __name__ == "__main__":
    start = int(input("Enter the first number: "))
    end = int(input("Enter the last number: "))
    graph(start, end)